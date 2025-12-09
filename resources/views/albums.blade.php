@extends('template')

@section('content')
    <h1 class="text-center">Liste des Albums</h1>
    <div class="filtres">
        <form method="GET" action="/albums">
            <input type="search" name="search" placeholder="Rechercher un titre..." value="{{ request('search') }}">

            <select name="date" id="dates">
                <option value="">Trie par date :</option>
                <option value="asc">Plus ancien au plus récent</option>
                <option value="desc">Plus récent au plus ancien</option>
            </select>

            <button type="submit" class="btn btn-primary">Filtrer</button>
            <a href="/albums" class="btn">Réinitialiser</a>
        </form>
    </div>
    <ul class="albums-list">

        @foreach ($lesAlbums as $album)
            <li class="album-item">
                <a href="/album/{{ $album->id }}">
                    <h3>{{ $album->titre }}</h3>
                    <div class="album-meta">
                        <span>Créé le : {{ $album->creation }}</span>
                        <span>•</span>
                        <span>Propriétaire : {{ $album->user->name ?? 'Inconnu' }}</span>
                    </div>
                </a>
            </li>
        @endforeach
    </ul>
@endsection