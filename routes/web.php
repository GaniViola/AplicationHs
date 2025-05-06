<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\UserController;

Route::middleware('guest')->group(function(){
    Route::get('/', function () {
        return view('pages.home');
    });

    Route::get('/secure-area/login', [AuthController::class, 'showLoginForm']);
    Route::post('/secure-area/login', [AuthController::class, 'login'])->name('login');
});

Route::middleware('auth')->group(function(){
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


    // Create Account
    Route::get('/CreateAccount', [UserController::class, 'index']);
    Route::post('/CreateAccount', [UserController::class, 'CreateAccount']);

    Route::get('/pesanan', function() {
        return view('admin.pages.PesananMasuk');
    });
    //pesanan masuk
    Route::get('/orders', [App\Http\Controllers\OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [App\Http\Controllers\OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{order}/accept', [App\Http\Controllers\OrderController::class, 'accept'])->name('orders.accept');
    Route::post('/orders/{order}/complete', [App\Http\Controllers\OrderController::class, 'complete'])->name('orders.complete');
    Route::post('/orders/{order}/ready-payment', [App\Http\Controllers\OrderController::class, 'readyForPayment'])->name('orders.readyPayment');
    Route::post('/orders/{order}/reject', [App\Http\Controllers\OrderController::class, 'reject'])->name('orders.reject');
    Route::get('/orders/{order}/details', [App\Http\Controllers\OrderController::class, 'getOrderDetails'])->name('orders.details');
});

    // Route::get('/pesanan', function() {
    //     return view('admin.pages.PesananMasuk');
    // });
