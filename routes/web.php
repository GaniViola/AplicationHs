<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/secure-area/login', [AuthController::class, 'showLoginForm']);
Route::post('/secure-area/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', function() {
    return view('admin.pages.home');
});
//category
Route::get('/categories', [CategoryController::class, 'index']);
Route::post('/categories', [CategoryController::class, 'store']);
Route::put('/categories/{id}', [CategoryController::class, 'update']);
Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);
//service
Route::resource('/services', ServicesController::class);
//manajemen user
// Customers
Route::get('/DataCustomer', [UserController::class, 'customers'])->name('admin.customers');
Route::patch('/DataCustomer/{id}/block', [UserController::class, 'blockCustomer'])->name('admin.customers.block');
Route::patch('/DataCustomer/{id}/activate', [UserController::class, 'activateCustomer'])->name('admin.customers.activate');
Route::post('/DataCustomer/bulk-action', [UserController::class, 'bulkAction'])->name('admin.customers.bulk');

Route::get('/pesanan', function() {
    return view('admin.pages.PesananMasuk');

    
});
