<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/ideas', 301);

Route::get('/ideas', [IdeaController::class, 'index'])->middleware('auth');
// ideas resource routes
Route::resource('ideas', IdeaController::class)->middleware('auth');
Route::get('/ideas/create', [IdeaController::class, 'create'])->middleware('auth');
// registration logic
Route::get('/register', [RegisteredUserController::class, 'create'])->Middleware('guest');
Route::post('/register', [RegisteredUserController::class, 'store'])->Middleware('guest');
//   login logic
Route::get('/login', [AuthController::class, 'create'])->name('login')->Middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->Middleware('guest');
Route::post('/logout', [AuthController::class, 'destroy'])->Middleware('auth');
