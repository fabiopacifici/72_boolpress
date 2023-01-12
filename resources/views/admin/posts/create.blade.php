@extends('layouts.admin')

@section('content')


<h1>Create a new Post</h1>
@if ($errors->any())

<div class="alert alert-danger" role="alert">
    <ul>
        @foreach ($errors->all() as $error )
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>


@endif


<form action="{{route('admin.posts.store')}}" method="post">
    @csrf

    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="learn laravel 9" aria-describedby="titleHelper" value="{{old('title')}}">
        <small id="titleHelper" class="text-muted">Add a title for the current post, max 100 characters, must be unique</small>
    </div>
    @error('title')
    <div class="alert alert-danger" role="alert">
        {{$message}}
    </div>
    @enderror

    <div class="mb-3">
        <label for="body" class="form-label">Body</label>
        <textarea class="form-control @error('body') is-invalid @enderror" name="body" id="body" rows="5">{{old('body')}}</textarea>
    </div>
    @error('body')
    <div class="alert alert-danger" role="alert">
        {{$message}}
    </div>
    @enderror
    <button type="submit" class="btn btn-primary">Create</button>
</form>
@endsection
