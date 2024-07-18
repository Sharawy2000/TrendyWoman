<?php
 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ResetPasswordController;

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function () {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/verify-phone/{token}', [AuthController::class, 'verify_phone'])->name('verify_phone');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api')->name('logout');
    Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:api')->name('refresh');
    Route::post('/me', [AuthController::class, 'me'])->middleware('auth:api')->name('me');
    Route::post('/update',[AuthController::class,'update_profile'])->middleware('auth:api')->name('update-profile');
    Route::post('/update-phone',[AuthController::class,'update_phone'])->middleware('auth:api')->name('update-phone');
    Route::post('/phone-code',[AuthController::class,'phone_code'])->middleware('auth:api')->name('phone-code');
    Route::post('/delete',[AuthController::class,'destroy'])->middleware('auth:api')->name('destroy-user');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'password'
], function () {
    Route::post('/forgot-password', [ResetPasswordController::class, 'forgot_password'])->name('forgot_password');
    Route::post('/check-code', [ResetPasswordController::class, 'check_code'])->name('check-code');
    Route::post('/reset/{token}',[ResetPasswordController::class,'reset_password'])->name('reset-password');
});

// Route::group([
//     'middleware' => 'auth:api',
//     'prefix' => 'home'
// ], function () {
//     Route::post('/', [HomeController::class, 'index'])->name('home');
//     Route::post('/refresh', [HomeController::class, 'refresh'])->name('refresh');
//     Route::post('/me', [HomeController::class, 'me'])->name('me');
//     Route::post('/update',[HomeController::class,'update_profile'])->name('update-profile');
//     Route::post('/update-phone',[HomeController::class,'update_phone'])->name('update-phone');
//     Route::post('/phone-code',[HomeController::class,'phone_code'])->name('phone-code');
// });
