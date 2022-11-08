@extends('layouts.app')

@section('content')

    @if (count($errors) > 0)
        @foreach ($errors->all() as $error)
            <p class="alert alert-danger alert-dismissible fade show" id="formMessage" role="alert">
                {{ $error }}
            </p>
        @endforeach
    @endif

    <form method="POST" action="{{isset($tag->id) ? route('tags.update', $tag->id) : route('tags.store')}}">
        @csrf

        @if(isset($tag->id))
            @method('PUT')
            @else
                @method('POST')
        @endif

        <div class="mb-3">
            <label for="title" class="form-label">Titre du tag</label>
            <input value="{{isset($tag->title) ? $tag->title : old('title')}}" name="title" type="title" class="form-control" id="title" aria-describedby="title">
        </div>
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>

@endsection