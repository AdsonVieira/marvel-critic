<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthUserController;
use App\Http\Controllers\UserRatingController;

use Illuminate\Support\Facades\Route;

Route::post('auth', [AuthUserController::class, 'auth']);

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::resource('movies', MovieController::class);
    Route::post('user-rating', [UserRatingController::class, 'rate']);
});

Route::resource('users', UserController::class);


