<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\TweetController;
use Illuminate\Support\Facades\Route;



Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('tweets/{tweet}/like', [LikeController::class, 'likeTweet']);
    Route::post('tweets/{tweet}/comment', [CommentController::class, 'addComment']);
    Route::apiResource('tweets', TweetController::class);

    Route::post('users/{user}/follow', [FollowController::class, 'followUser']);
    
    Route::get('timeline', [TweetController::class, 'timeline']);

});
