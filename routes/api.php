<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\MemberController;

Route::prefix('v1')->group(function () {
    // Member Routes
    Route::get('/members', [MemberController::class, 'index']);

    // Post Routes
    Route::get('/posts', [PostController::class, 'index']);

    Route::get('/posts/home', [PostController::class, 'home']);

    Route::get('/posts/gallery', [PostController::class, 'gallery']);

    Route::get('/posts/{slug}', [PostController::class, 'detail']);
});
