@extends('layouts.admin')

@section('content')


<h1>Edit Post</h1>
@if ($errors->any())

<div class="alert alert-danger" role="alert">
    <ul>
        @foreach ($errors->all() as $error )
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>


@endif


<form action="{{route('admin.posts.update', $post->slug)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="learn laravel 9" aria-describedby="titleHelper" value="{{old('title', $post->title)}}">
        <small id="titleHelper" class="text-muted">Add a title for the current post, max 100 characters, must be unique</small>
    </div>
    @error('title')
    <div class="alert alert-danger" role="alert">
        {{$message}}
    </div>
    @enderror

    <div class="mb-3 d-flex gap-4">
        <img width="140" src="{{ asset('storage/' . $post->cover_image)}}" alt="">
        <div>
            <label for="cover_image" class="form-label">Replace Cover Image</label>
            <input type="file" name="cover_image" id="cover_image" class="form-control  @error('cover_image') is-invalid @enderror" placeholder="" aria-describedby="coverImageHelper">
            <small id="coverImageHelper" class="text-muted">Replace the post cover image</small>
        </div>
    </div>
    <!-- TODO: Add validation errors -->


    <div class="mb-3">
        <label for="category_id" class="form-label">Categories</label>
        <select class="form-select form-select-lg @error('category_id') 'is-invalid' @enderror" name="category_id" id="category_id">
            <option value="">Delect category</option>

            <!--
                TODO: Fix Attempt to read property "id" on null
                When a post has been updated and its category is Null
            -->
            @foreach ($categories as $category )
            <option value="{{$category->id}}" {{ $category->id == old('category_id', $post->category->id) ? 'selected' : '' }}>
                {{$category->name}}
            </option>
            @endforeach

        </select>
    </div>
    @error('category_id')
    <div class="alert alert-danger" role="alert">
        {{$message}}
    </div>
    @enderror



    <div class="mb-3">
        <label for="body" class="form-label">Body</label>
        <textarea class="form-control @error('body') is-invalid @enderror" name="body" id="body" rows="5">{{old('body', $post->body)}}</textarea>
    </div>
    @error('body')
    <div class="alert alert-danger" role="alert">
        {{$message}}
    </div>
    @enderror
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection
