@extends('layouts.app')

@section('content')
    <div class="d-flex flex-row justify-content-start gap-5">
        <div class="shadow p-5 mb-5 bg-body rounded border border-primary d-flex flex-column gap-3">
            <a href="admin/posts" class="btn btn-primary flex-fill text-uppercase fs-2">Articles</a>
            <p>Création, Modification, Supression</p>
        </div>
        <div class="shadow p-5 mb-5 bg-body rounded border border-primary d-flex flex-column gap-3">
            <a href="admin/categories" class="btn btn-primary flex-fill text-uppercase fs-2">Categories</a>
            <p>Création, Modification, Supression</p>
        </div>
    </div>
@endsection