<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\alert;

class Main extends Controller
{

    public function index() {












        return view('index');
    }

    public function LesAlbums() {
        $lesAlbums = DB::SELECT("SELECT * FROM albums ORDER BY id");









        return view('albums', ['lesAlbums' => $lesAlbums]);
    }

    public function detailAlbum($id) {
        $album = DB::select("SELECT * FROM photos WHERE album_id = ?", [$id]);









        return view('album', ['album' => $album]);
    }

    public function LesPhotos() {
        











        return view('photos');
    }

    public function lesTags() {
        $tags = DB::SELECT("SELECT * FROM tags ORDER BY id");











        return view('tags', ['tags' => $tags]);
    }

    public function detailTag($id) {
        $tag = DB::select("SELECT tags.id, tags.nom, photos.id AS photo_id, photos.titre
                            FROM tags
                            LEFT JOIN possede_tag ON tags.id = possede_tag.tag_id
                            LEFT JOIN photos ON possede_tag.photo_id = photos.id
                            WHERE tags.id = 1");








        return view('tag', ['tag' => $tag]);
    }

    public function ajoutPhoto() {
        











        return view('ajoutPhoto');
    }
}
?>