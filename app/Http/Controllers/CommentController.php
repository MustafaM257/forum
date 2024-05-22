<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;


class CommentController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Post $post)
    {
        //
        $validated_comment = $request->validate([
            'body' => ['required','string','min:1','max:500'],
        ]);
        $comment = Comment::make($validated_comment);
        $comment->user()->associate($request->user());
        $comment->post()->associate($post);
        $comment->save();
        return to_route('posts.show',$post)->with('flash', [
            'bannerStyle' => 'success',
            'banner' => 'Comment added successfully!',
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {

        if ($request->user()->cannot('update', $comment)) {
            abort(403);
        }
        //
        $data = $request->validate([
            'body'=>['required','string','min:1','max:500'],
        ]);
        $comment->update($data);
        return to_route('posts.show',[
            'post' =>$comment->post_id,
            'page' => $request->query('page'),
        ])->with('flash', [
            'bannerStyle' => 'success',
            'banner' => 'Comment updated successfully!',
        ]);;;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request , Comment $comment)
    {
        if ($request->user()->cannot('delete', $comment)) {
            abort(403);
        }
        //
//        $this->authorize('delete', $comment);
        $comment->delete();
        return to_route('posts.show',[
            'post' => $comment->post_id,
            'page' => $request->query('page'),
        ])->with('flash', [
        'bannerStyle' => 'success',
        'banner' => 'Comment deleted successfully!',
    ]);
    }
}
