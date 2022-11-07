@extends('layouts.app')

@section('content')

    @if(isset($post))
        <h1 class="mb-4">{{$post->title}}</h1>
        ​<p>{{$post->description}}</p>
        <img src="/images/{{$post->image_file_name}}" alt="">
        @else
            <h1>Error No Article Founded</h1>
    @endif

@endsection