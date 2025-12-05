@extends('template')

@section('content')
    <h1>Détails de l'Album</h1>

    <div class="filtres">
        <form method="GET" action="/album/{{ $album->id }}">
            <input type="search" name="search" placeholder="Recherche titre..." value="{{ request('search') }}">

            <select name="tag_id" id="tags">
                <option value="">Sélectionnez un tag</option>
                @foreach ($tags as $t)
                    <option value="{{ $t->id }}" @selected(request('tag_id') == $t->id)>{{ $t->nom }}</option>
                @endforeach
            </select>

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

                @if(Auth::check() && $photo->user_id === Auth::id())
                    <form method="POST" action="/deletePhoto/{{ $photo->id }}">
                        @csrf
                        <button type="submit">Supprimer la photo</button>
                    </form>
                @endif
            </div>
        @endforeach
    </div>
@endsection