<?php

use App\Http\Controllers\api\v1\PostApiController;



//use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\PostController;
//use App\Http\Controllers\CommentController;
//use App\Http\Controllers\TagController;

//Rest API (Restful API)=>HTTP standard 
//Request=> GET<POST<PUT<DELETE<PATCH
//Response=> 200,201,204,400,404,500
Route::prefix('v1')->group(function () {
    Route::apiResource('post', PostApiController::class);
});

