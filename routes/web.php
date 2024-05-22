<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');



    Route::resource('posts',PostController::class)->only(['store','create']);
    Route::resource('posts.comments',CommentController::class)->shallow()->only(['store','update','destroy']);
//    Route::post('/posts/{post}/comments',[CommentController::class,'store'])->name('posts.comments.store');
//    Route::delete('/comments/{comment}',[CommentController::class,'destroy'])->name('comments.destroy')->can('delete','comment');
//    Route::put('/comments/{comment}',[CommentController::class,'update'])->name('comments.update')->can('update','comment');


});

Route::resource('posts',PostController::class)->only(['index','show']);
//
//Route::get('posts', [PostController::class, 'index'])->name('posts.index');
//Route::get('posts/{post}', [PostController::class, 'show'])->name('posts.show');
//
//Route::get('test',function(){
//    return [
//        \App\Http\Resources\UserResource::make(User::find(1)),
//        \App\Http\Resources\PostResource::make(\App\Models\Post::find(1)),
//        \App\Http\Resources\CommentResource::make(\App\Models\Comment::find(1)),
//    ];
//});
