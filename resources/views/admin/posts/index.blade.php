@extends('layouts.admin')

@section('content')

<h1>Posts</h1>
<!-- TODO: move in a partial -->
@if (session('message'))
<div class="alert alert-success">
    {{ session('message') }}
</div>
@endif

<a class="btn btn-primary position-fixed bottom-0 end-0 m-3" href="{{route('admin.posts.create')}}" role="button">
    <i class="fas fa-plus fa-lg fa-fw"></i>
</a>
<div class="table-responsive">
    <table class="table table-striped
    table-hover
    table-borderless
    table-primary
    align-middle">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Slug</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @forelse ($posts as $post)
            <tr class="table-primary">
                <td scope="row">{{$post->id}}</td>
                <td>{{$post->title}}</td>
                <td>{{$post->slug}}</td>
                <td>

                    <a class="btn btn-primary btn-sm" href="{{route('admin.posts.show', $post->slug)}}" role="button"><i class="fas fa-eye fa-sm fa-fw"></i></a>
                    <a class="btn btn-secondary btn-sm" href="{{route('admin.posts.edit', $post->slug)}}"><i class="fas fa-pencil fa-sm fa-fw"></i></a>





                    <!-- Modal trigger button -->
                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#post-{{$post->id}}">
                        <i class="fas fa-trash fa-sm fa-fw"></i>
                    </button>

                    <!-- Modal Body -->
                    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                    <div class="modal fade" id="post-{{$post->id}}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modal-{{$post->id}}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modal-{{$post->id}}">Delete {{$post->title}}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this post?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                    <form action="{{route('admin.posts.destroy', $post->slug)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Confirm</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>







                </td>
            </tr>
            @empty
            <tr>
                <td>No posts in the db yet</td>
            </tr>
            @endforelse
        </tbody>
        <tfoot>

        </tfoot>
    </table>
</div>



@endsection
