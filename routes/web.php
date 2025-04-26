<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ServicesController;

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/secure-area/login', [AuthController::class, 'showLoginForm']);
Route::post('/secure-area/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', function() {
    return view('admin.pages.home');
});

Route::get('/categories', [CategoryController::class, 'index']);
Route::post('/categories', [CategoryController::class, 'store']);
Route::put('/categories/{id}', [CategoryController::class, 'update']);
Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);
Route::resource('/services', ServicesController::class);
Route::get('/pesanan', function() {
    return view('admin.pages.PesananMasuk');

    
});
