<?php

use Illuminate\Support\Facades\Route;

// Public Captive Portal
Route::get('/portal', 'App\Http\Controllers\Web\CaptivePortalController@show');

// Protected Admin Dashboard
Route::middleware(['auth'])->group(function () {
    Route::get('/', 'App\Http\Controllers\Web\DashboardController@index');
    
    // Franchise Management
    Route::get('/franchises', 'App\Http\Controllers\Web\FranchiseWebController@index')->name('franchises.index');
    Route::post('/franchises', 'App\Http\Controllers\Web\FranchiseWebController@store')->name('franchises.store');
    Route::delete('/franchises/{franchise}', 'App\Http\Controllers\Web\FranchiseWebController@destroy')->name('franchises.destroy');

    Route::get('/devices', 'App\Http\Controllers\Web\DeviceWebController@index');
    Route::get('/vouchers', 'App\Http\Controllers\Web\VoucherWebController@index')->name('vouchers.index');
    Route::post('/vouchers', 'App\Http\Controllers\Web\VoucherWebController@store')->name('vouchers.store');
    Route::delete('/vouchers/{voucher}', 'App\Http\Controllers\Web\VoucherWebController@destroy')->name('vouchers.destroy');
});

// Auth Routes (Login/Logout)
Route::get('/login', function () {
    return view('auth.login');
})->name('login')->middleware('guest');

Route::post('/login', 'App\Http\Controllers\Api\AuthController@login');
Route::post('/logout', 'App\Http\Controllers\Api\AuthController@logout')->name('logout');
