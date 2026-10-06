<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisteredUserController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// registration logic
Route::get('/register', [RegisteredUserController::class, 'create'])->Middleware('guest');
Route::post('/register', [RegisteredUserController::class, 'store'])->Middleware('guest');
//   login logic
Route::get('/login', [AuthController::class, 'create'])->Middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->Middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->Middleware('auth');
