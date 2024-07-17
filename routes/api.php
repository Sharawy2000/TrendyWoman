<?php
 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ResetPasswordController;

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function () {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/verify-phone/{phone}', [AuthController::class, 'verify_phone'])->name('verify_phone');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api')->name('logout');
    Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:api')->name('refresh');
    Route::post('/me', [AuthController::class, 'me'])->middleware('auth:api')->name('me');
    Route::post('/update',[AuthController::class,'update_profile'])->middleware('auth:api')->name('update-profile');
    Route::post('/update-phone',[AuthController::class,'update_phone'])->middleware('auth:api')->name('update-phone');
    Route::post('/phone-code/{new_phone}',[AuthController::class,'phone_code'])->middleware('auth:api')->name('phone-code');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'password'
], function () {
    Route::post('/forgot-password', [ResetPasswordController::class, 'forgot_password'])->name('forgot_password');
    Route::post('/check-code', [ResetPasswordController::class, 'check_code'])->name('check-code');
    Route::post('/reset/{token}',[ResetPasswordController::class,'reset_password'])->name('reset-password');
});
