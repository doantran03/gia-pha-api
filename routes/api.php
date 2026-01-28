<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\MemberController;

Route::prefix('v1')->group(function () {
    Route::get('/members', [MemberController::class, 'index']);

    Route::get('/posts', [PostController::class, 'index']);
});
