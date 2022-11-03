@extends('layouts.app')

@section('content')

    @if(!$posts->isEmpty())
        @foreach ($posts as $post)
            <h1>{{$post->title}}</h1>
            <p>{{$post->description}}</p>
            <small>{{$post->created_at->format('d/m/Y')}}</small>
        @endforeach
    @endif

@endsection