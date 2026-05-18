<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DeviceController;
use App\Http\Controllers\Api\VoucherController;
use App\Http\Controllers\Api\SessionController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\FirmwareController;
use App\Http\Controllers\Api\FranchiseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/auth/login', [AuthController::class, 'login']);

// Device Endpoints
Route::prefix('device')->group(function () {
    Route::post('/register', [DeviceController::class, 'register']);
    Route::post('/heartbeat', [DeviceController::class, 'heartbeat']);
    Route::get('/firmware/check', [FirmwareController::class, 'checkUpdate']);
});

// Captive Portal Endpoints
Route::post('/sessions/authorize', [SessionController::class, 'authorize']);
Route::post('/vouchers/validate', [VoucherController::class, 'validateVoucher']);

// Payment Webhooks
Route::post('/payments/gcash/webhook', [PaymentController::class, 'gcashWebhook']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', [AuthController::class, 'me']);
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    
    // Franchise APIs
    Route::apiResource('franchises', FranchiseController::class);
    
    // Protected Voucher APIs
    Route::post('/vouchers/generate', [VoucherController::class, 'generate']);
    
    // Protected Firmware APIs
    Route::post('/firmware/upload', [FirmwareController::class, 'upload']);
});






