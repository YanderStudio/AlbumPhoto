@extends('template')

@section('content')
    <h1>Détails de l'Album</h1>
    <div class="album">
        @foreach ($album->photos as $photo)
        <div class="photo">
            <p>{{ $photo->titre }} | note : {{ $photo->note }}</p>
            <img src="{{ $photo->url }}" alt="{{ $photo->titre }}">
        </div>
        @endforeach
    </div>
@endsection