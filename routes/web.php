<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\DashboardController;

Route::get('/login', [AuthController::class, 'loginForm'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->middleware('guest');

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard');
    
    // Member Routes
    Route::get('/members', [MemberController::class, 'index'])
        ->name('members.index');

    Route::get('/members/get-mother-by-father/{fatherId}', [MemberController::class, 'getMotherByFather'])
        ->name('members.getMotherByFather');

    Route::get('/member/create', [MemberController::class, 'create'])
        ->name('members.create');

    Route::post('/member', [MemberController::class, 'store'])
        ->name('members.store');

    Route::get('/member/edit/{memberId}', [MemberController::class, 'edit'])
        ->name('members.edit');

    Route::put('/member/update/{memberId}', [MemberController::class, 'update'])
        ->name('members.update');

    Route::delete('/member/delete/{memberId}', [MemberController::class, 'delete'])
        ->name('members.delete');

    // Post Routes
    Route::get('/posts', [PostController::class, 'index'])
        ->name('posts.index');

    Route::get('/post/create', [PostController::class, 'create'])
        ->name('posts.create');
    
    Route::post('/post', [PostController::class, 'store'])
        ->name('posts.store');

    Route::get('/post/edit/{postId}', [PostController::class, 'edit'])
        ->name('posts.edit');

    Route::put('/post/update/{postId}', [PostController::class, 'update'])
        ->name('posts.update');

    Route::delete('/post/delete/{postId}', [PostController::class, 'delete'])
        ->name('posts.delete');
});
