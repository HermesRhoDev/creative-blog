@extends('layouts.app')

@section('content')

    @if (count($errors) > 0)
        @foreach ($errors->all() as $error)
            <p class="alert alert-danger alert-dismissible fade show" id="formMessage" role="alert">
                {{ $error }}
            </p>
        @endforeach
    @endif

    <form method="POST" action="{{isset($category->id) ? route('categories.update', $category->id) : route('categories.store')}}">
        @csrf

        @if(isset($category->id))
            @method('PUT')
            @else
                @method('POST')
        @endif

        <div class="mb-3">
            <label for="title" class="form-label">Titre de la catégorie</label>
            <input value="{{isset($category->title) ? $category->title : old('title')}}" name="title" type="title" class="form-control" id="title" aria-describedby="title">
        </div>
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>

@endsection