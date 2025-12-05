@extends('template')

@section('content')
    <div class="book-container">
        <h1>Liste des Albums</h1>

        <div class="photo-album-grid">
            @foreach ($lesAlbums as $album)
                {{-- Le lien <a> englobe maintenant tout l'item --}}
                <a href="/album/{{ $album->id }}" class="full-link">
                    <div class="photo-slot item"> 
                        <h3>{{ $album->titre }}</h3>
                        <p>Propriété : {{ $album->user->name ?? 'Inconnu' }}</p>
                        
                        {{-- L'image n'a plus besoin d'être dans un lien séparé --}}
                        <img src="{{ $album->couverture_url ?? asset('images/default_album.jpg') }}" 
                             alt="Couverture de l'album {{ $album->titre }}">
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection