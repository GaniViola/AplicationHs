<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SetoranController;

Route::middleware('guest')->group(function(){
    Route::get('/', function () {
        return view('pages.home');
    });

    Route::get('/test-404', function () {
    abort(404);
    });

    Route::get('/secure-area/login', [AuthController::class, 'showLoginForm']);
    Route::post('/secure-area/login', [AuthController::class, 'login'])->name('login');
});

Route::middleware('auth')->group(function(){
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', function() {
        return view('admin.pages.home', [
            'title' => 'Dashboard'
        ]);
    });

    
    // ✅ ROUTE SETORAN ADMIN
    Route::prefix('admin/setoran')->name('admin.setoran.')->controller(SetoranController::class)->group(function () {
        Route::get('/', 'index')->name('index');           // admin.setoran.index
        Route::get('/create', 'create')->name('create');   // admin.setoran.create
        Route::post('/', 'store')->name('store');          // admin.setoran.store
        Route::put('/{id}', 'update')->name('update');     // admin.setoran.update
    });

    Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/laporan-gaji', [SetoranController::class, 'laporanGaji'])->name('gaji.index');
 
});
 Route::get('/laporan/pendapatan', [SetoranController::class, 'laporanPendapatan'])->name('admin.laporan.pendapatan');
 // Route untuk export PDF
Route::get('/laporan/pendapatan/pdf', [SetoranController::class, 'exportPdf'])->name('admin.pages.pendapatan.pdf');

// Route untuk export Excel
Route::get('/laporan/pendapatan/excel', [SetoranController::class, 'exportExcel'])->name('admin.pages.pendapatan.excel');
    // category
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::put('/categories/{id}', [CategoryController::class, 'update']);
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);

    // service
    Route::resource('/services', ServicesController::class);

    // manajemen user
    Route::get('/DataCustomer', [UserController::class, 'customers'])->name('admin.customers');
    Route::patch('/DataCustomer/{id}/block', [UserController::class, 'blockCustomer'])->name('admin.customers.block');
    Route::patch('/DataCustomer/{id}/activate', [UserController::class, 'activateCustomer'])->name('admin.customers.activate');
    Route::post('/DataCustomer/bulk-action', [UserController::class, 'bulkAction'])->name('admin.customers.bulk');

    Route::get('/CreateAccount', [UserController::class, 'index']);
    Route::post('/CreateAccount', [UserController::class, 'CreateAccount']);

    // pesanan masuk
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{order}/accept', [OrderController::class, 'accept'])->name('orders.accept');
    Route::post('/orders/{order}/complete', [OrderController::class, 'complete'])->name('orders.complete');
    Route::post('/orders/{order}/ready-payment', [OrderController::class, 'readyForPayment'])->name('orders.readyPayment');
    Route::post('/orders/{order}/reject', [OrderController::class, 'reject'])->name('orders.reject');
    Route::get('/orders/{order}/details', [OrderController::class, 'getOrderDetails'])->name('orders.details');
    Route::post('/orders/assign-worker', [OrderController::class, 'assignWorker'])->name('orders.assignWorker');

    // lainnya
    Route::get('/UserMaster', [UserController::class, 'ShowUserMaster']);
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('destroyuser');

});




