<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $posts = Post::orderByDesc('id')->get();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        //dd($request->all());
        //validate data
        $val_data = $request->validated();
        //dd($val_data);
        // Save the input cover_image
        if ($request->hasFile('cover_image')) {
            $cover_image = Storage::put('uploads', $val_data['cover_image']);
            //dd($cover_image);
            // replace the value of cover_image inside $val_data
            $val_data['cover_image'] = $cover_image;
        }
        // generate post slug
        $post_slug = Post::generateSlug($val_data['title']);
        $val_data['slug'] = $post_slug;
        // create posts
        //dd($val_data);
        Post::create($val_data);
        // redirect
        return to_route('admin.posts.index')->with('message', 'Posts added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //dd($request->all());

        // validate data
        $val_data = $request->validated();
        //dd($val_data);

        // check if the request has a cover_image field
        if ($request->hasFile('cover_image')) {
            // check if the current post has an image if yes, delete it
            if ($post->cover_image) {
                Storage::delete($post->cover_image);
            }
            $cover_image = Storage::put('uploads', $val_data['cover_image']);
            //dd($cover_image);
            // replace the value of cover_image inside $val_data
            $val_data['cover_image'] = $cover_image;
        }
        //dd($val_data);

        // update the slug
        $post_slug = Post::generateSlug($val_data['title']);
        $val_data['slug'] = $post_slug;
        //dd($val_data);
        // update the resource
        $post->update($val_data);
        // redirect to a get route
        return to_route('admin.posts.index')->with('message', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if ($post->cover_image) {
            Storage::delete($post->cover_image);
        }

        $post->delete();
        return to_route('admin.posts.index')->with('message', 'Post Deleted successfully');
    }
}
