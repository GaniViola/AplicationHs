<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporangajiController;
use App\Http\Controllers\LaporanpekerjaController;
use App\Http\Controllers\LaporanpendapatanController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SetoranController;
use App\Http\Controllers\WorkPhotoController;

Route::middleware('guest')->group(function(){
    Route::get('/', function () {
        return view('pages.home');
    })->name('home');

      Route::get('/about', function () {
        return view('pages.about');
    })->name('about');

     Route::get('/service', function () {
        return view('pages.service');
    })->name('service');

     Route::get('/blog', function () {
        return view('pages.blog');
    })->name('blog');

     Route::get('/feature', function () {
        return view('pages.feature');
    })->name('feature');

     Route::get('/contact', function () {
        return view('pages.contact');
    })->name('contact');

     Route::get('/team', function () {
        return view('pages.team');
    })->name('team');

     Route::get('/testimonial', function () {
        return view('pages.testimonial');
    })->name('testimonial');


     Route::get('/offer', function () {
        return view('pages.offer');
    })->name('offer');

     Route::get('/faq', function () {
        return view('pages.faq');
    })->name('faq');

    Route::get('/test-404', function () {
    abort(404);
    });

    Route::get('/secure-area/login', [AuthController::class, 'showLoginForm']);
    Route::post('/secure-area/login', [AuthController::class, 'login'])->name('login');
});

Route::middleware('auth')->group(function(){
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index']);

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

    Route::get('/dashboard', [DashboardController::class, 'index']);
   // ✅ ROUTE SETORAN ADMIN
   Route::prefix('admin/setoran')->name('admin.setoran.')->controller(SetoranController::class)->group(function () {
    Route::get('/', 'index')->name('index');           // admin.setoran.index
    Route::get('/create', 'create')->name('create');   // admin.setoran.create
    Route::post('/', 'store')->name('store');          // admin.setoran.store
    Route::put('/{id}', 'update')->name('update');     // admin.setoran.update
});
    Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/laporan-gaji', [LaporangajiController::class, 'laporanGaji'])->name('gaji.index');
    });
    Route::get('/laporan/pendapatan', [LaporanpendapatanController::class, 'laporanPendapatan'])->name('admin.laporan.pendapatan');
    // Route untuk export PDF
    Route::get('/laporan/pendapatan/pdf', [LaporanpendapatanController::class, 'exportPdf'])->name('admin.pages.pendapatan.pdf');
    Route::get( '/laporan/gaji/pdf', [LaporangajiController::class, 'exportPdf'])->name('admin.laporan.gaji.pdf');
    Route::get('/laporan/pekerja/Pdf', [LaporanpekerjaController::class, 'exportPdf'])->name('admin.laporan.pekerja.pdf');
    // Route untuk export Excel
    Route::get('/laporan/pendapatan/excel', [LaporanpendapatanController::class, 'exportExcel'])->name('admin.pages.pendapatan.excel');
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
    //create account
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
    //laporan foto pekerja
   Route::get('/admin/laporan-pekerja', [LaporanpekerjaController::class, 'index'])->name('admin.laporan.pekerja');

});
