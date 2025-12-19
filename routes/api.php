<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::post('login', [LoginController::class, 'login']);
});

Route::middleware("auth:sanctum")->group(function () {
    Route::get('users', [UserController::class, 'users']);
    Route::post('logout', [LoginController::class, 'logout']);
});
