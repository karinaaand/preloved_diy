<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

Route::get('/', fn() => view('index'));

// Auth
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

// User
Route::middleware('role:user')->group(function(){
    Route::get('/user/dashboard', [UserController::class,'dashboard']);
});

// Admin
Route::middleware('role:admin')->group(function(){
    Route::get('/admin/dashboard', [AdminController::class,'dashboard']);
    Route::post('/admin/products', [AdminController::class,'store']);
});
