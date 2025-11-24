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

    public function albums() {
        











        return view('albums');
    }

    public function album($id) {
        











        return view('album');
    }

    public function photos() {
        











        return view('photos');
    }

    public function lesTags() {
        $tags = DB::SELECT("SELECT * FROM tags ORDER BY id");











        return view('tags', ['tags' => $tags]);
    }

    public function tag($id) {
        $tag = DB::SELECT("SELECT id FROM tags
                           LEFT JOIN tag_id ON 
        ")









        return view('tag');
    }

    public function ajoutPhoto() {
        











        return view('ajoutPhoto');
    }
}
?>