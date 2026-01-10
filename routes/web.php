<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\ContactController;

// ## Public Routes
Route::get('/', IndexController::class);

Route::get('/contact', [ContactController::class, 'index']);
Route::post('/contact', [ContactController::class, 'store']);

Route::get('/job', [JobController::class, 'index']);

Route::resource('tags', TagController::class);

Route::get('/signup', [AuthController::class, 'showSingnupForm'])->name('signup');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

Route::post('/signup', [AuthController::class, 'Signup']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ## Protected Routes
Route::middleware('auth')->group(function () {


    Route::middleware('role:viewer.editor,admin')->group(function () {
        Route::get('/blog', [PostController::class, 'index']);
        Route::get('/blog/{id}', [PostController::class, 'show']);
        Route::resource('comments', CommentController::class);
    });

    Route::middleware('role:editor,admin')->group(function () {
        Route::get('/blog/{id}/edit', [PostController::class, 'edit']);
        Route::patch('/blog/{id}', [PostController::class, 'update']);
    });

    Route::middleware('role:admin')->group(function () {
        Route::get('/blog/create', [PostController::class, 'create']);
        Route::post('/blog', [PostController::class, 'store']);
        Route::delete('/blog/{id}', [PostController::class, 'destroy']);
    });

});

Route::get('/about', AboutController::class);