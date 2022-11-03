@extends('layouts.app')

@section('content')
    @if(Session::has('success')) 
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

    <a href="/posts/create">Ajouter un article</a>
    @if(!$posts->isEmpty())
        @foreach ($posts as $post)
            <h1>{{$post->title}}</h1>
            <p>{{$post->description}}</p>
            <small>{{$post->created_at->format('d/m/Y')}}</small>
            <a href="{{route('posts.edit', $post->id)}}">Update</a>
            <form action="{{route('posts.destroy', ['id' => $post->id])}}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger btn-block">Delete</button>
            </form>
        @endforeach
        @else
            <h1>NO ARTICLE</h1>
    @endif

@endsection