<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


// Route::get('/posts',[PostController::class,'index'])->name('posts.index');

// Route::get('/view',[PostController::class,'store']);

// Route::post('/create',[PostController::class,'store'])->name('posts.store');

// Route::get('/view',[PostController::class,'view']);

// Route::get('/create', [PostController::class,'create'])->name('posts.create');

// Route::middleware('auth')->group(function(){
//     Route::get('/create',[PostController::class,'create'])->name('posts.create');
//     Route::post('/create', [PostController::class, 'store'])->name('posts.store');
//     Route::get('/view', [PostController::class, 'view'])->name('posts.view');
// });
// Route::get('posts/{id}/edit',[PostController::class,'edit'])->name('posts.edit');

// Route::put('posts/{id}', [PostController::class,'update'])->name('posts.update');

// Route::delete('/posts/{id}',[PostController::class,'destroy'])->name('posts.delete');


Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::post('/create', [PostController::class, 'store'])->name('posts.store');
Route::get('/view', [PostController::class, 'view'])->name('posts.view');

Route::middleware('auth')->group(function () {
    Route::get('/create', [PostController::class, 'create'])->name('posts.create');
    Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.delete');
});
