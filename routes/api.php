<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::get('/posts' , [App\Http\Controllers\PostController::class, 'index']);
Route::apiResource('posts','App\Http\Controllers\PostController');
Route::apiResource('categories','App\Http\Controllers\CategoryController');
Route::get('category/{slug}/posts',[App\Http\Controllers\PostController::class, 'categoryPosts']);
Route::get('searchposts/{query}',[App\Http\Controllers\PostController::class, 'searchposts']);
Route::post('login', [App\Http\Controllers\UserController::class,'login']);
Route::post('register', [App\Http\Controllers\UserController::class,'register']);
Route::middleware('auth:api')->group(function () {
    Route::get('user', [App\Http\Controllers\UserController::class,'details']);
    Route::post('comment/create', [App\Http\Controllers\CommentController::class,'store']);

});

Route::group(['prefix'=>'/admin','middleware'=>'auth:api'],function(){
    Route::get('posts','App\Http\Controllers\AdminController@getPosts');
    Route::get('categories','App\Http\Controllers\AdminController@getCategories');
    Route::post('addPost','App\Http\Controllers\AdminController@addPost');
    Route::post('updatePost','App\Http\Controllers\AdminController@updatePost');
    Route::post('deletePosts','App\Http\Controllers\AdminController@deletePosts');
});
