@extends('layouts.app')

@section('content')

    <div class="px-4 py-5 my-5 text-center">
        <img class="d-inline-block mb-3" src="https://www.creative-formation.fr/wp-content/themes/creative-formation/assets/lettre-creative.svg" alt="Le C du logo Créative Formation" style="width: 50px">
        <h1 class="display-5 fw-bold">Bienvenue sur le blog de Créative</h1>
        <div class="col-lg-6 mx-auto">
            <p class="lead mb-4">Retrouvez-ici nos dernières actualités !</p>
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                <a class="btn btn-primary btn-lg px-4 gap-3" href="#news">Accédez aux actualités</a>
            </div>
        </div>
    </div>

    @if(!$posts->isEmpty())
        <h1 class="mb-4">Les derniers articles : </h1>
        ​
        <div class="list-group w-auto mb-4">
            @foreach ($posts as $post)
                <a href="{{route('posts.show', ['slug' =>$post->slug, 'id' => $post->id])}}" class="list-group-item list-group-item-action d-flex gap-3 py-3">
                    <div class="d-flex gap-2 w-100 justify-content-between">
                        <div>
                            <h6 class="mb-0">{{$post->title}}</h6>
                            <p class="mb-0 opacity-75">{{$post->description}}</p>
                        </div>
                        <small class="opacity-50 text-nowrap">{{$post->created_at}}</small>
                    </div>
                </a>
            @endforeach
        </div>
    @endif
@endsection