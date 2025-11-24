@extends('template')

@section('content')
<ul>
@foreach($tags as $tag)
    <li>
        <a href="{{ url('/tag' . $tag->id)}}">{{$tag -> nom}}</a>
    </li>
    @endforeach
</ul>
@endsection