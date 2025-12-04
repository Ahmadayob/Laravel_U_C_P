<?php

use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PostController;

Route::get('/', [IndexController::class, 'index']);
Route::get('/about', [IndexController::class, 'about']);
Route::get('/contact', [IndexController::class, 'contact']);
Route::get('/job', [JobController::class, 'index']);

Route::get('/blog', [PostController::class, 'index']);
Route::get('/blog/create', [PostController::class, 'create']);
Route::get('/blog/{id}/delete', [PostController::class, 'delete']);
Route::get('/blog/{myId}', [PostController::class, 'show']);

Route::get('/comments',[CommentController::class,'index']);
Route::get('/comments/create',[CommentController::class,'create']);
