@extends('layouts.app')

@section('content')

    @if(isset($post))
        <h1 class="mb-4">{{$post->title}}</h1>
        ​<p>{{$post->description}}</p>
        @else
            <h1>Error No Article Founded</h1>
    @endif

@endsection