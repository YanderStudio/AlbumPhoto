@extends('template')

@section('content')
    <h1>Liste des Albums</h1>
    <ul>
        @foreach ($lesAlbums as $album)
            <li><a href="/album/{{ $album->id }}">{{ $album->titre }} (date de création : {{ $album->creation }})</a></li>
        @endforeach
    </ul>
@endsection