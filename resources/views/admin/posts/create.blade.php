@extends('layouts.app')

@section('content')

    <form method="POST" action="{{isset($post->id) ? route('posts.update', $post->id) : route('posts.store')}}">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Titre de l'article</label>
            <input value="{{isset($post->title) ? $post->title : old('title')}}" name="title" type="title" class="form-control" id="title" aria-describedby="title">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Contenu de l'article</label>
            <textarea name="description" class="form-control" id="description" rows="3">{{isset($post->description) ? $post->description : old('description')}}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>

@endsection