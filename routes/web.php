<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SectionController;
use App\Models\Post;

Route::get('/app', function () {
    return view('layouts.app');
});

Route::get('/', function () {
    $posts = Post::latest()->paginate(10);
    return view('home', ['posts' => $posts]);
})->name('home');

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

// Route to list all sections
Route::get('/sections', [SectionController::class, 'index'])->name('sections.index');

// Route to show form for creating a new section
Route::get('/sections/create', [SectionController::class, 'create'])->name('sections.create');

// Route to store a new section
Route::post('/sections', [SectionController::class, 'store'])->name('sections.store');

// Route to show form for editing a specific section
Route::get('/sections/{section}/edit', [SectionController::class, 'edit'])->name('sections.edit');

// Route to update a specific section
Route::put('/sections/{section}', [SectionController::class, 'update'])->name('sections.update');

// Route to delete a specific section
Route::delete('/sections/{section}', [SectionController::class, 'destroy'])->name('sections.destroy');
route::resource('sections', SectionController::class);