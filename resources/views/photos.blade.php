@extends('template')

@section('content')
    <h1>Galerie de Photos</h1>

    <div class="filtres">
        <form method="GET" action="/photos">
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
                    <option value="{{ $n }}" @selected((string)request('note') === (string)$n)>{{ $n }}</option>
                @endforeach
            </select>

            <button type="submit">Filtrer</button>
            <a href="/photos" style="margin-left:8px;">Réinitialiser</a>
        </form>
    </div>

    <div class="galery">
        @foreach ($photos as $photo)
            <div class="item">
                <h3>{{ $photo->titre}} </h3>
                <p>Album : {{ $photo->album_id}} <i class='bx bxs-star'></i> {{ $photo->note }}</p>
                <a href="album/{{ $photo->album_id }}"><img src="{{ $photo->url }}" alt="{{ $photo->titre }}"></a>
            </div>
        @endforeach
    </div>
@endsection