@extends('template')
//photos(id,titre, url, note, album_id, user_id)
@section('content')
<form method="POST" action="/traitementFormulaire" enctype="multipart/form-data">
    @csrf

    <label for="titre">Titre de la photo :</label><br>
    <input type="text" id="titre" name="titre" value="{{ old('titre') }}" required><br />
    @error('titre') <div style="color:red">{{ $message }}</div> @enderror
    <br />

    <label for="photo">Fichier image :</label><br>
    <input type="file" id="photo" name="photo" accept="image/*" required><br />
    @error('photo') <div style="color:red">{{ $message }}</div> @enderror
    <br />

    <label for="note">Note de la photo (1-5) :</label><br>
    <input type="number" id="note" name="note" min="1" max="5" value="{{ old('note', 1) }}" required><br />
    @error('note') <div style="color:red">{{ $message }}</div> @enderror
    <br />

    <label for="album_id">Album :</label><br>
    <select id="album_id" name="album_id" required>
        <option value="">Sélectionnez un album</option>
        @foreach($albums as $album)
            <option value="{{ $album->id }}" @selected(old('album_id') == $album->id)>{{ $album->titre }}</option>
        @endforeach
    </select>
    @error('album_id') <div style="color:red">{{ $message }}</div> @enderror
    <br /><br />

    <label for="tag_id">Tag existant (optionnel) :</label><br>
    <select id="tag_id" name="tag_id">
        <option value="">Aucun</option>
        @foreach($tags as $tag)
            <option value="{{ $tag->id }}" @selected(old('tag_id') == $tag->id)>{{ $tag->nom }}</option>
        @endforeach
    </select>
    @error('tag_id') <div style="color:red">{{ $message }}</div> @enderror
    <br /><br />

    <label for="new_tag">Ou ajouter un nouveau tag (minuscule, sans espace, sans accents ni caractères spéciaux) :</label><br>
    <input type="text" id="new_tag" name="new_tag" value="{{ old('new_tag') }}" placeholder="ex: vacances" />
    @error('new_tag') <div style="color:red">{{ $message }}</div> @enderror
    <br /><small>Si vous renseignez un nouveau tag, il sera normalisé et utilisé à la place du tag existant.</small>
    <br /><br />

    <input type="submit" value="Ajouter la photo">
</form>
@endsection