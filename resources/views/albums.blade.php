@extends('template')

@section('content')
    <div class="book-container">
        <h1>Liste des Albums</h1>

        <div class="photo-album-grid">
            @foreach ($lesAlbums as $album)
                {{-- Le lien <a> englobe maintenant tout l'item --}}
                <a href="/album/{{ $album->id }}" class="full-link">
                    <div class="photo-slot"> 
                        <h3>{{ $album->titre }}</h3>
                        <p>Propriété : {{ $album->user->name ?? 'Inconnu' }}</p>
                        
                        @php
                            $firstPhoto = $album->photos->first();
                            $imageUrl = $firstPhoto ? $firstPhoto->url : asset('images/default_album.jpg');
                        @endphp
                        
                        <div class="album-cover">
                            <img src="{{ $imageUrl }}" alt="Couverture de l'album {{ $album->titre }}">
                        </div>
                        
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection