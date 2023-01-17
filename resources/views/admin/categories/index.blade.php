@extends('layouts.admin')


@section('content')


<h1>All Categories here</h1>
@if ($errors->any())

<div class="alert alert-danger" role="alert">
    <ul>
        @foreach ($errors->all() as $error )
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>


@endif

<div class="container-fluid">
    <div class="row">
        <div class="col pe-4">
            Form to create a new category

            <form action="{{route('admin.categories.store')}}" method="post">
                @csrf

                <div class="input-group mb-3">
                    <input id="name" name="name" type="text" class="form-control" placeholder="Category name" aria-label="Category name " aria-describedby="button-addon">
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon">Button</button>
                </div>
            </form>
        </div>
        <div class="col">

            <div class="table-responsive-md">
                <table class="table table-striped table-hover table-borderless table-primary align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Posts Count</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">

                        @forelse ($categories as $category)

                        <tr class="table-primary">
                            <td scope="row">{{$category->id}}</td>
                            <td>{{$category->name}}</td>
                            <td>{{$category->slug}}</td>
                            <td>xxx</td>
                            <td>Delete</td>
                        </tr>


                        @empty
                        <tr class="table-primary">
                            <td scope="row">No categories</td>

                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>

                    </tfoot>
                </table>
            </div>



        </div>

    </div>
</div>


@endsection
