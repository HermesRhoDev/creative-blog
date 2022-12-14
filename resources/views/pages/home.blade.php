@extends('layouts.app')

@section('content')

    <div class="px-4 py-5 my-5 text-center">
        <img class="d-inline-block mb-3" src="https://www.creative-formation.fr/wp-content/themes/creative-formation/assets/lettre-creative.svg" alt="Le C du logo Créative Formation" style="width: 50px">
        <h1 class="display-5 fw-bold">Bienvenue sur le blog de Créative</h1>
        <div class="col-lg-6 mx-auto">
            <p class="lead mb-4">Retrouvez-ici nos dernières actualités !</p>
        </div>
    </div>

    @if(!$posts->isEmpty())
        <h1 class="mb-4">Les derniers articles : </h1>

        <div class="container">
            <div class="row">
                <div class="col-8">
                    <div class="list-group w-auto mb-4">
                        @foreach ($posts as $post)
                            <a href="{{route('posts.show', ['id' => $post->id, 'slug' => $post->slug])}}" class="list-group-item list-group-item-action d-flex gap-3 py-3">
                                <div class="d-flex flex-column">
                                    @if(isset($post->category) != null)
                                        <p>{{$post->category->title}}</p>
                                    @endif
                                    <div class="d-flex gap-2 justify-content-between">
                                        <div>
                                            <h6 class="mb-0">{{$post->title}}</h6>
                                            <p class="mb-0 opacity-75">{{$post->description}}</p>
                                        </div>
                                        <small class="opacity-50 text-nowrap">{{$post->created_at}}</small>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
                <div class="col-4 d-flex flex-column gap-5">
                    <div class="d-flex flex-column gap-2">
                        <h3>Catégories</h3>
                        @if (isset($categories))
                            @foreach ($categories as $category)
                                <a href="/category/{{$category->id}}" class="btn btn-primary">{{$category->title}}</a>
                            @endforeach
                        @endif
                    </div>
                    <div class="d-flex flex-column gap-2">
                        <h3>Tags</h3>
                        @if (isset($tags))
                            @foreach ($tags as $tag)
                                <a href="/tag/{{$tag->id}}" class="btn btn-primary">{{$tag->title}}</a>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @else
            <div class="w-100 text-center">
                <h1 class="">Il n'y a actuellement auncun article disponible</h1>
            </div>​
    @endif
    
@endsection