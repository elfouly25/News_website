<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\AdminController;
use App\Models\Post;

Route::get('register', function () {
    return view('auth.user-register');
})->name('UserRegister');

Route::view('/user-login', 'auth.user-login')->name('UserLogin');

Route::view('/forgot-password', 'auth.passwords.reset-password')->name('password.request');

Route::get('/', function () {
    $posts = Post::latest()->paginate(10);
    return view('home', ['posts' => $posts]);
})->name('home');

// Post routes
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

// Section routes
Route::get('/sections', [SectionController::class, 'index'])->name('sections.index');
Route::get('/sections/create', [SectionController::class, 'create'])->name('sections.create');
Route::post('/sections', [SectionController::class, 'store'])->name('sections.store');
Route::get('/sections/{section}/edit', [SectionController::class, 'edit'])->name('sections.edit');
Route::put('/sections/{section}', [SectionController::class, 'update'])->name('sections.update');
Route::delete('/sections/{section}', [SectionController::class, 'destroy'])->name('sections.destroy');

// Admin routes
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::get('/admin/login-success', [AdminController::class, 'showLoginSuccess'])->name('admin.login.success');
