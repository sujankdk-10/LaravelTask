<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', function(){
    return view('index');
});


Route::get('/admin/dashboard', [AdminController::class,'dashboard'])
    ->middleware(['auth','verified'])
    ->name('admin.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/create', [PostController::class, 'create'])->name('posts.create');
    Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.delete');
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
});

require __DIR__.'/auth.php';





Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::post('/create', [PostController::class, 'store'])->name('posts.store');
Route::get('/view', [PostController::class, 'view'])->name('posts.view');

Route::middleware('auth')->group(function () {
    
});


