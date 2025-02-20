<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PostController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:api')->group(function () {
    Route::get('posts', [PostController::class, 'index']);
    Route::post('posts', [PostController::class, 'store'])->middleware('can:create,App\Models\Post');

    Route::put('posts/{post}', [PostController::class, 'update'])->middleware('can:edit,post');
    Route::delete('posts/{post}', [PostController::class, 'destroy'])->middleware('can:delete,post');

    Route::post('logout', [AuthController::class, 'logout']);
});


