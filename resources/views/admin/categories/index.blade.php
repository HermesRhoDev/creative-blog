@extends('layouts.app')

@section('content')
    @if(Session::has('success')) 
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

    <h1>Catégories : </h1>
    <a class="btn btn-info text-white fw-semibold text-uppercase btn-block mb-3" href="categories/create">Ajouter une categorie</a>

    @if(!$categories->isEmpty())
        @foreach ($categories as $categorie)
            <h1>{{$categorie->title}}</h1>
        @endforeach
    @endif

@endsection