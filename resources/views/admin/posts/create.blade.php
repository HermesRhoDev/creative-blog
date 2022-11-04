@extends('layouts.app')

@section('content')
    @if (count($errors) > 0)
        @foreach ($errors->all() as $error)
        <p class="alert alert-danger alert-dismissible fade show" id="formMessage" role="alert">
            {{ $error }}
        </p>
        @endforeach
    @endif

    <form method="POST" action="{{isset($post->id) ? route('posts.update', $post->id) : route('posts.store')}}">
        @csrf

        @if (isset($post->id))
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
            <input class="form-check-input" type="checkbox" name="isPublished" id="flexCheckDefault" {{isset($post->isPublished) && $post->isPublished ? "checked" : ""}}>
            <label class="form-check-label" for="flexCheckDefault">
              Publié
            </label>
        </div>
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>

@endsection