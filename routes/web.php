<?php

use App\Http\Controllers\Admin\ForgetPasswordController;
use App\Http\Controllers\Admin\SubAdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\LogoutController;
use App\Models\Post;
use App\Http\Controllers\HomeController;

// Home route
Route::get('/', [HomeController::class, 'index'])->name('home');

// Search route
Route::get('/posts/search', [PostController::class, 'search'])->name('posts.search');
Route::get('/post/{post}', [PostController::class, 'show'])->name('posts.show');

// Route to display posts by section
Route::get('/posts/section/{id}', [PostController::class, 'indexBySection'])->name('posts.bySection');

// Admin routes
Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [LoginController::class, 'login'])->name('admin.login.submit');

// Protect admin routes with auth middleware
Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/dashboard', [LoginController::class, 'showLoginSuccess'])->name('login.success');
    Route::post('/admin/logout', [LogoutController::class, 'logout'])->name('admin.logout');
    
    // Section routes
    Route::get('/sections', [SectionController::class, 'index'])->name('sections.index');
    Route::get('/sections/create', [SectionController::class, 'create'])->name('sections.create');
    Route::post('/sections', [SectionController::class, 'store'])->name('sections.store');
    Route::get('/sections/{section}/edit', [SectionController::class, 'edit'])->name('sections.edit');
    Route::put('/sections/{section}', [SectionController::class, 'update'])->name('sections.update');
    Route::delete('/sections/{section}', [SectionController::class, 'destroy'])->name('sections.destroy');
    // Route for reordering sections
    Route::post('/sections/reorder', [SectionController::class, 'reorder'])->name('sections.reorder');
    // Route for displaying all posts
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
});

Route::get('/password/forget', [ForgetPasswordController::class, 'showLinkRequestForm'])->name('password.request');



Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/manage-admins', [SubAdminController::class, 'index'])->name('admin.index'); // List of admins
    Route::get('/admin/manage-admins/create', [SubAdminController::class, 'create'])->name('admin.create'); // Form to create admin
    Route::post('/admin/manage-admins', [SubAdminController::class, 'store'])->name('admin.store'); // Store admin
    Route::get('/admin/manage-admins/{id}/edit', [SubAdminController::class, 'edit'])->name('admin.edit'); // Edit admin
    Route::put('/admin/manage-admins/{id}', [SubAdminController::class, 'update'])->name('admin.update'); // Update admin
    Route::delete('/admin/manage-admins/{id}', [SubAdminController::class, 'destroy'])->name('admin.destroy'); // Delete admin
});