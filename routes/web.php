<?php

use Illuminate\Support\Facades\Route;

// Public Captive Portal
Route::get('/portal', 'App\Http\Controllers\Web\CaptivePortalController@show');

// Protected Admin Dashboard
Route::middleware(['auth'])->group(function () {
    Route::get('/', 'App\Http\Controllers\Web\DashboardController@index');
    Route::get('/devices', 'App\Http\Controllers\Web\DeviceWebController@index');
    Route::get('/vouchers', 'App\Http\Controllers\Web\VoucherWebController@index');
});

// Auth Routes (Login/Logout)
Route::get('/login', function () {
    return view('auth.login');
})->name('login')->middleware('guest');

Route::post('/login', 'App\Http\Controllers\Api\AuthController@login');
Route::post('/logout', 'App\Http\Controllers\Api\AuthController@logout')->name('logout');
