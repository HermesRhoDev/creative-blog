@extends('layouts.app')

@section('content')
    @if(Session::has('success')) 
        <div id="alert" class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

    <a class="btn btn-info text-white fw-semibold text-uppercase btn-block mb-3" href="posts/create">Ajouter un article</a>

    @if(!$posts->isEmpty() && $posts->count() >= 2)   
        <form action="{{route('posts.truncate')}}" method="POST" class="mb-3">
            @csrf
            <button type="submit" class="btn btn-danger btn-block" onclick="if(!confirm('Voulez-vous vraiment supprimer tous les articles ?')) {return false;}">Supprimer tous les articles</button>
        </form>
    @endif

    @if(!$posts->isEmpty())
        <div class="list-group">
            @foreach ($posts as $post)
                <div class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">Titre: {{$post->title}}</h5>
                        @if(isset($post->image_file_name))
                            <img src="../images/thumbnail/{{$post->image_file_name}}" alt="">
                        @endif
                        <div class="d-flex gap-3 align-items-center">
                            <small class="bg-info text-white p-2 rounded-3 fw-semibold">{{$post->created_at->format('d/m/Y')}}</small>
                            @if ($post->isPublished === 1)
                                <div class="bg-dark text-white p-2 rounded-3 fw-semibold text-uppercase">Publié</div>
                                @else
                                    <div class="bg-warning p-2 rounded-3 fw-semibold text-uppercase">En attente de publication</div>
                            @endif
                        </div>
                    </div>
                    <p class="mb-1 truncate overflow-hidden white-space-now-wrap">{{$post->description}}</p>
                    <div class="d-flex gap-3 justify-content-end">
                        <a class="btn btn-warning btn-block" href="{{route('posts.edit', $post->id)}}"><i class="bi bi-pencil text-white"></i></a>
                        <form action="{{route('posts.destroy', ['id' => $post->id])}}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-block" onclick="if(!confirm('Voulez-vous vraiment supprimer cet article ?')) {return false;}">X</button>
                        </form>
                    </div>
                    <div class="d-flex gap-2 align-items-center">
                        <h4>Tags:</h4>
                        @foreach ($post->tags as $tag)
                            <p class="tag">{{$tag->title}}</p>
                        @endforeach
                    </div>
                </div>
            @endforeach
            @else
                <h1>AUCUN ARTICLE ACTUELLEMENT</h1>
        </div>
    @endif

@endsection