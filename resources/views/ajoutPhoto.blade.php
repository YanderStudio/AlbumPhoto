@extends('template')
//photos(id,titre, url, note, album_id)
@section('content')
<form method="POST" action="/traitementFormulaire">
    @csrf
    <label for="titre">Titre de la photo :</label>
    <input type="text" id="titre" name="titre" required><br><br>

    <label for="url">URL de la photo :</label>
    <input type="text" id="url" name="url" required><br><br>

    <label for="note">Note de la photo (1-5) :</label>
    <input type="number" id="note" name="note" min="1" max="5" required><br><br>

    <label for="album_id">ID de l'album :</label>
    <input type="number" id="album_id" name="album_id" required><br><br>

    <input type="submit" value="Ajouter la photo">
</form>
@endsection