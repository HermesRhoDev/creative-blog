@extends('layouts.app')

@section('content')
    @if(Session::has('success')) 
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

    <h1>Tags : </h1>
    <a class="btn btn-info text-white fw-semibold text-uppercase btn-block mb-3" href="tags/create">Ajouter un tag</a>

    @if(!$tags->isEmpty())
        <div class="list-group">
            @foreach ($tags as $tag)
                <div class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">{{$tag->title}}</h5>
                        <div class="d-flex gap-3 align-items-center">
                            <small class="bg-info text-white p-2 rounded-3 fw-semibold">{{$tag->created_at->format('d/m/Y')}}</small>
                        </div>
                    </div>
                    <br>
                    <div class="d-flex gap-3 justify-content-end">
                        <a class="btn btn-warning btn-block" href="{{route('tags.edit', $tag->id)}}"><i class="bi bi-pencil text-white"></i></a>
                        <form action="{{route('tags.destroy', ['id' => $tag->id])}}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-block" onclick="if(!confirm('Voulez-vous vraiment supprimer cette catégorie ?')) {return false;}">X</button>
                        </form>
                    </div>
                </div>
            @endforeach
            @else
                <h1>AUCUN TAG ACTUELLEMENT</h1>
        </div>
    @endif

@endsection