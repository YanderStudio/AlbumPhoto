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
        











        return view('tags');
    }

    public function tag($id) {
        











        return view('tag');
    }

    public function ajoutPhoto() {
        











        return view('ajoutPhoto');
    }
}
?>