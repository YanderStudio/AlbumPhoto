@extends('template')

@section('content')
    <h1>Détails de l'Album</h1>

    <div class="filtres">
        <form method="GET" action="/album/{{ $album->id }}">
            <label for="tags">Filtrer par tags :</label>
            <select name="tag_id" id="tags">
                <option value="">Sélectionnez un tag</option>
                @foreach ($tags as $t)
                    <option value="{{ $t->id }}" @selected(request('tag_id') == $t->id)>{{ $t->nom }}</option>
                @endforeach
            </select>

            <label for="notes">Filtrer par notes :</label>
            <select name="note" id="notes">
                <option value="">Sélectionnez une note</option>
                @foreach ($notes as $n)
                    <option value="{{ $n }}" @selected((string) request('note') === (string) $n)>{{ $n }}</option>
                @endforeach
            </select>

            <button type="submit">Filtrer</button>
            <a href="/album/{{ $album->id }}" style="margin-left:8px;">Réinitialiser</a>
        </form>
    </div>

    <div class="album">
        @foreach ($photos as $photo)
            <div class="photo">
                <p>{{ $photo->titre }} | note : {{ $photo->note }}</p>
                <img src="{{ $photo->url }}" alt="{{ $photo->titre }}">
            </div>
        @endforeach
    </div>
@endsection