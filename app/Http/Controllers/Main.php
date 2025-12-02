<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Photo;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\alert;

class Main extends Controller
{

    public function index()
    {












        return view('index');
    }

    public function LesAlbums()
    {
        $lesAlbums = Album::all();







        return view('albums', ['lesAlbums' => $lesAlbums]);
    }

    public function detailAlbum($id, Request $request)
    {
        $album = Album::findOrFail($id);
        $query = Photo::where('album_id', $id);

        if ($request->filled('tag_id')) {
            $query->whereHas('tags', function ($q) use ($request) {
                $q->where('tags.id', $request->input('tag_id'));
            });
        }

        if ($request->filled('note')) {
            $query->where('note', $request->input('note'));
        }

        $photos = $query->get();

        $tags = Tag::orderBy('nom')->get();
        $notes = Photo::select('note')->distinct()->orderBy('note')->pluck('note');



        return view('album', [
            'album' => $album,
            'photos' => $photos,
            'tags' => $tags,
            'notes' => $notes,
        ]);
    }

    public function LesPhotos(Request $request)
    {
        // Construire la requête photo avec filtres Eloquent
        $query = Photo::query();

        if ($request->filled('tag_id')) {
            $query->whereHas('tags', function ($q) use ($request) {
                $q->where('tags.id', $request->input('tag_id'));
            });
        }

        if ($request->filled('note')) {
            $query->where('note', $request->input('note'));
        }

        $photos = $query->get();

        // Tags et notes pour les selects (Eloquent)
        $tags = Tag::orderBy('nom')->get();
        $notes = Photo::select('note')->distinct()->orderBy('note')->pluck('note');

        return view('photos', [
            'photos' => $photos,
            'tags' => $tags,
            'notes' => $notes,
        ]);
    }

    public function lesTags()
    {
        $tags = DB::SELECT("SELECT * FROM tags ORDER BY id");











        return view('tags', ['tags' => $tags]);
    }


    public function detailTag($id)
    {
        $tag = Tag::with('photos')->find($id);

        return view('tag', ['tag' => $tag]);
    }



    public function ajoutPhoto()
    {












        return view('ajoutPhoto');
    }
    public function traitementFormulaire(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'url' => 'required|url',
            'note' => 'required|integer|min:1|max:5',
            'album_id' => 'required|integer|exists:albums,id',
        ]);

        DB::table('photos')->insert([
            'titre' => $request->input('titre'),
            'url' => $request->input('url'),
            'note' => $request->input('note'),
            'album_id' => $request->input('album_id'),
        ]);

        return redirect('/photos')->with('success', 'Photo ajoutée avec succès !');
    }
}
?>