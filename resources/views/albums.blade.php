@extends('template')

@section('content')
    <div class="book-container">
        <h1>Liste des Albums</h1>
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

        <div class="photo-album-grid">
            @foreach ($lesAlbums as $album)
                <a href="/album/{{ $album->id }}" class="full-link">
                    <div class="photo-slot"> 
                        <h3>{{ $album->titre }}</h3>
                        <div class="album-meta">
                            <span>Créé le : {{ $album->creation }}</span>
                            <span>•</span>
                            <span>Propriétaire : {{ $album->user->name ?? 'Inconnu' }}</span>
                        </div>
                        
                        @php
                            $firstPhoto = $album->photos->first();
                        @endphp
                        
                        <div class="album-cover">
                            @if($firstPhoto)
                                <img src="{{ $firstPhoto->url }}" alt="Couverture de l'album {{ $album->titre }}">
                            @else
                                <span class="album-empty">Album vide</span>
                            @endif
                        </div>
                        
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection