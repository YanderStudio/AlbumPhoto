<?php

use GuzzleHttp\Psr7\Uri;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Main;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [Main::class, 'index']); //accueil
Route::get('/albums', [Main::class, 'lesAlbums']); //pages des diff albums
Route::get('/album/{id}', [Main::class, 'detailAlbum'])->where("id", "[0-9]+"); //page montrant les diff photos d'un album
Route::get('/photos', [Main::class, 'lesPhotos']); //bonus afficher toutes les photos
Route::get('/tags', [Main::class, 'lesTags']); //afficher les diff tags
Route::get('/tag/{id}', [Main::class, 'detailTag'])->where("id", "[0-9]+"); //page montrant les diff photos d'un tag
Route::get('/ajoutPhoto', [Main::class, 'ajoutPhoto'])->middleware('auth'); //formulaire d'ajout de photo (spé web)
Route::post('/traitementFormulaire', [Main::class, 'traitementFormulaire'])->middleware('auth'); //traitement du formulaire d'ajout de photo (spé web)
Route::get('/compte', [Main::class, 'monCompte']); //page de gestion du compte utilisateur (spé web)

Route::get('/creerAlbum', [Main::class, 'creerAlbum'])->middleware('auth');
Route::post('/storeAlbum', [Main::class, 'storeAlbum'])->middleware('auth');

Route::post('/deletePhoto/{id}', [Main::class, 'deletePhoto'])->where("id", "[0-9]+")->middleware('auth');

//Bonus :
//créer des commentaires sur les photos
//créer des comptes et suivres d'autres utilisateurs et leurs albums publics
//liké des photos et ils apparaissent dans une page "mes favoris"