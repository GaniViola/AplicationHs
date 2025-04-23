<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/secure-area/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/secure-area/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// coba
Route::get('/cobasb', function() {
    return view('admin.layouts.app');
});