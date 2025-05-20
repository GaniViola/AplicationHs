<?php

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\WorkPhotoController;
use App\Http\Controllers\Api\WorkerOrderController;
use App\Http\Controllers\Api\StatusPekerjaanController;
use App\Http\Controllers\Api\StatistikWorkerController;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Api Login Redister
Route::post('/register', [ApiController::class, 'register']);
Route::post('login', [ApiController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
Route::post('/logout', [ApiController::class, 'logout']);
Route::post('/change-password', [AuthController::class, 'changePassword']);

// Rute untuk mengambil profil pengguna
Route::get('/profile', [ApiController::class, 'getUserProfile']);

// Rute untuk memperbarui profil pengguna
Route::put('/profile/update', [ApiController::class, 'updateUserProfile']);




});

Route::post('/check-email', [AuthController::class, 'checkEmail']);
Route::post('/send-otp', [AuthController::class, 'sendOtp']);
Route::get('/categories', [CategoryController::class, 'index']);
Route::post('/ubahpassword', [AuthController::class, 'ubahpassword']);


Route::get('/services', [ServiceController::class, 'index']);
Route::post('/orders', [OrderController::class, 'store']);

Route::get('/orders', [OrderController::class, 'history']);
Route::get('/orders/user/{id}', [OrderController::class, 'getUserOrders']);

//upload foto
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/my-orders', [WorkerOrderController::class, 'index']);
    Route::post('/upload-image', [WorkPhotoController::class, 'store']);
});

//history pekerja
Route::post('/get-worker-history', [OrderController::class, 'getWorkerHistory']);

//status pekerjaan
Route::middleware('auth:sanctum')->get('/status-pekerjaan', [StatusPekerjaanController::class, 'index']);

//statistik pekerja
Route::middleware(['auth:sanctum'])->get('/worker/statistik', [StatistikWorkerController::class, 'index']);
