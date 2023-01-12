@extends('layouts.admin')

@section('content')

<h1>{{$post->title}}</h1>
<h5>{{$post->slug}}</h5>
<div class="content">
    {{$post->body}}
</div>
@endsection
