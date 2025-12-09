<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Album;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Main extends Controller
{

    public function index()
    {
        // on va ajouter après des fonctionnalités







        return view('index');
    }

    public function lesAlbums(Request $request)
    {
        $query = Album::query();
        // tri par date
        if ($request->filled('date')) {
            $order = $request->input('date') === 'asc' ? 'asc' : 'desc';
            $query->orderBy('creation', $order);
        } else {
            $query->orderBy('titre', 'asc');
        }

        //tri par recherche
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('titre', 'LIKE', "%{$search}%");
        }

        $lesAlbums = $query->get();
        


        //affiche les albums
        return view('albums', ['lesAlbums' => $lesAlbums]);
    }

    public function detailAlbum($id, Request $request)
    {
        $album = Album::findOrFail($id);

        // Début (Filtres)
        $query = Photo::where('album_id', $id);

        // selection par tags
        if ($request->filled('tag_id')) {
            $query->whereHas('tags', function ($q) use ($request) {
                $q->where('tags.id', $request->input('tag_id'));
            });
        }

        // selection par notes
        if ($request->filled('note')) {
            $query->where('note', $request->input('note'));
        }

        // selection par recherche
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('titre', 'LIKE', "%{$search}%");
        }

        // fin (Filtres)
        $photos = $query->get();

        // pour afficher dans le form des Filtres
        $tags = Tag::orderBy('nom')->get();
        $notes = Photo::select('note')->distinct()->orderBy('note')->pluck('note');


        //afficher les photos d'un Album + Filtres
        return view('album', [
            'album' => $album,
            'photos' => $photos,
            'tags' => $tags,
            'notes' => $notes,
        ]);
    }

    public function lesPhotos(Request $request)
    {
        // Début (Filtres)
        $query = Photo::query();

        // selection par tags
        if ($request->filled('tag_id')) {
            $query->whereHas('tags', function ($q) use ($request) {
                $q->where('tags.id', $request->input('tag_id'));
            });
        }

        // selection par notes
        if ($request->filled('note')) {
            $query->where('note', $request->input('note'));
        }

        // selection par recherche
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('titre', 'LIKE', "%{$search}%");
        }

        // fin (Filtres)
        $photos = $query->get();

        // pour afficher dans le form des Filtres
        $tags = Tag::orderBy('nom')->get();
        $notes = Photo::select('note')->distinct()->orderBy('note')->pluck('note');

        //afficher les photos + form filtres
        return view('photos', [
            'photos' => $photos,
            'tags' => $tags,
            'notes' => $notes,
        ]);
    }

    public function lesTags()
    {
        $tags = DB::SELECT("SELECT * FROM tags ORDER BY id");










        // on va suppr
        return view('tags', ['tags' => $tags]);
    }


    public function detailTag($id)
    {
        $tag = Tag::with('photos')->find($id);
        // on va suppr
        return view('tag', ['tag' => $tag]);
    }


    public function ajoutPhoto()
    {
        //vient chercher les tags et albums
        $albums = Album::orderBy('titre')->get();
        $tags = Tag::orderBy('nom')->get();
        //return les tags et albums dans le form
        return view('ajoutPhoto', [
            'albums' => $albums,
            'tags' => $tags,
        ]);
    }


    public function traitementFormulaire(Request $request)
    {

        $request->validate([
            'titre' => 'required|string|max:255',
            'photo' => 'required|image|max:5120',
            'note' => 'required|integer|min:1|max:5',
            'album_id' => 'required|integer|exists:albums,id',
            'tag_id' => 'nullable|integer|exists:tags,id',
            'new_tag' => 'nullable|string|max:50',
        ]);

        // Stock l'image dans le public
        $path = $request->file('photo')->store('photos', 'public');
        $url = Storage::url($path);

        // eeee
        $selectedTagId = null;

        if ($request->filled('new_tag')) {
            // Normaliser : enlever accents, mettre en minuscules, supprimer tout ce qui n'est pas a-z0-9
            $raw = $request->input('new_tag');
            $normalized = Str::lower(Str::ascii($raw));
            $normalized = preg_replace('/[^a-z0-9]/', '', $normalized);

            if ($normalized === '') {
                return back()->withErrors(['new_tag' => 'Tag invalide après normalisation. Utilisez des lettres et chiffres uniquement.'])->withInput();
            }

            // Créer ou récupérer le tag (colonne nom)
            $tag = Tag::firstOrCreate(['nom' => $normalized]);
            $selectedTagId = $tag->id;
        } elseif ($request->filled('tag_id')) {
            $selectedTagId = $request->input('tag_id');
        }

        // Insérer la photo et récupérer l'id (Query Builder pour rester cohérent)
        $photoId = DB::table('photos')->insertGetId([
            'titre' => $request->input('titre'),
            'url' => $url,
            'note' => $request->input('note'),
            'album_id' => $request->input('album_id'),
            'user_id' => Auth::id(),
        ]);

        // Lier le tag sélectionné / créé (si présent)
        if ($selectedTagId) {
            DB::table('possede_tag')->insert([
                'photo_id' => $photoId,
                'tag_id' => $selectedTagId,
            ]);
        }

        return redirect('/photos')->with('success', 'Photo ajoutée avec succès !');
    }


    public function creerAlbum()
    {
        return view('creerAlbum');
    }

    public function storeAlbum(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
        ]);

        Album::create([
            'titre' => $request->input('titre'),
            'creation' => date('Y-m-d'),
            'user_id' => Auth::id(),
        ]);

        return redirect('/albums')->with('success', 'Album créé avec succès !');
    }


    public function deletePhoto($id)
    {
        $photo = Photo::findOrFail($id);

        if (Auth::check() && $photo->user_id === Auth::id()) {
            $photo->delete();
            return redirect()->back()->with('success', 'Photo supprimée avec succès !');
        }

        return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à supprimer cette photo.');
    }
}
?>