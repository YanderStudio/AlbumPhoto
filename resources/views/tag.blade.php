@extends('template')

@section('content')
    @if ($tag && $tag->photos->count() > 0)
        <ul>
            @foreach ($tag->photos as $photo)
                <li>
                    <a href="{{ url('/photo/' . $photo->id) }}">{{ $photo->titre }}</a>
                </li>
            @endforeach
        </ul>
    @else
        <p>No photo.</p>
    @endif
@endsection