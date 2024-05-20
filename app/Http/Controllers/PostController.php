<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResource;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Inertia::render('Posts/Index',[
            'posts'=> PostResource::collection(Post::with('user')->latest()->latest('id')->paginate())
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return Inertia::render('Posts/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $post_data = $request->validate([
            'title'=>['required','string','min:3','max:100'],
            'body'=>['required','string','min:50','max:10000'],
        ]);
        $post = Post::make($post_data);
        $post->user()->associate($request->user())->save();
        return to_route('posts.show',$post);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
        $post->load('user');
        return Inertia::render('Posts/Show', [
            'post' => PostResource::make($post),
            'comments' => CommentResource::collection($post->comments()->with('user')->latest()->latest('id')->paginate(10)),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
