<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
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

     //pesanan masuk
     Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
     Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
     Route::post('/orders/{order}/accept', [OrderController::class, 'accept'])->name('orders.accept');
     Route::post('/orders/{order}/complete', [OrderController::class, 'complete'])->name('orders.complete');
     Route::post('/orders/{order}/ready-payment', [OrderController::class, 'readyForPayment'])->name('orders.readyPayment');
     Route::post('/orders/{order}/reject', [OrderController::class, 'reject'])->name('orders.reject');
     Route::get('/orders/{order}/details', [OrderController::class, 'getOrderDetails'])->name('orders.details');
     Route::post('/orders/assign-worker', [OrderController::class, 'assignWorker'])->name('orders.assignWorker');
    // Route::get('/pesanan', function() {
    //     return view('admin.pages.PesananMasuk');
 
    Route::get('/UserMaster', [UserController::class, 'ShowUserMaster']);

});




