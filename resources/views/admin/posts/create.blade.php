@extends('layouts.app')

@section('content')
    @if (count($errors) > 0)
        @foreach ($errors->all() as $error)
        <p class="alert alert-danger alert-dismissible fade show" id="formMessage" role="alert">
            {{ $error }}
        </p>
        @endforeach
    @endif

    <form method="POST" action="{{isset($post->id) ? route('posts.update', $post->id) : route('posts.store')}}" enctype="multipart/form-data">
        @csrf

        @if(isset($post->id))
            @method('PUT')
            @else
                @method('POST')
        @endif

        <div class="mb-3">
            <label for="title" class="form-label">Titre de l'article</label>
            <input value="{{isset($post->title) ? $post->title : old('title')}}" name="title" type="title" class="form-control" id="title" aria-describedby="title">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Contenu de l'article</label>
            <textarea name="description" class="form-control" id="description" rows="3">{{isset($post->description) ? $post->description : old('description')}}</textarea>
        </div>
        <div class="mb-3">
            <input type="file" name="image_file_name" id="image_file_name">
            <img id="thumb" src="" width="150px"/>
        </div>
        @if(!$tags->isEmpty())
            <div class="mb-3">
                <select name="tags[]" multiple>
                    @foreach ($tags as $tag)
                        <option value="{{$tag->id}}" 
                            @if(
                                (isset($post) && in_array($tag->id, old('tags', $post->tags->pluck('id')->toArray())))
                                || (in_array($tag->id, old('tags', [])))
                                )

                                selected
                            @endif
                        >{{isset($tag->title) ? $tag->title : old('title')}}</option>
                    @endforeach
                </select>
            </div>
        @endif
        <div class="mb-3">
            <label for="category_id" class="form-label">
                Catégorie
            </label>
            <select class="form-select" name="category_id" aria-label="Default select example">
                <option value="">Aucune</option>
                @foreach ($categories as $category)
                    <option value="{{$category->id}}" 
                        {{-- LARAVEL COLLECTIVE A VERIFIER --}}
                        @if(
                            (isset($post) && $category->id == old('category_id', $post->category_id)) ||
                            $category->id == old('category_id')
                        )
                            selected
                        @endif
                        >{{isset($category->title) ? $category->title : old('title')}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <input class="form-check-input" type="checkbox" name="isPublished" id="flexCheckDefault" {{isset($post->isPublished) && $post->isPublished ? "checked" : ""}}>
            <label class="form-check-label" for="flexCheckDefault">
              Publié
            </label>
        </div>
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>

@endsection