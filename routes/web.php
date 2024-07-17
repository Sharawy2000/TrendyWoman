<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

Route::get('/', function () {
    return view('welcome');
});
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth','admin','verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/home',[HomeController::class,'index'])->name('home');
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php';

// Route::get('register', [UserController::class, 'login'])
//                 ->name('register');

// Route::get('login', [UserController::class, 'register'])
//                 ->name('login');

Route::group([

    'prefix'=> "auth/",

],function (){

    Route::group([

        'prefix' => 'user',
        'controller'=>UserController::class,

    ], function () {

        Route::post('/login', 'login');
        Route::post('/register', 'register');
        Route::post('/logout', 'logout');
        Route::post('/refresh', 'refresh');
        Route::put('/edit', 'update');
        Route::get('/{token}', 'verify_email');
        Route::post('/user-profile/{id}', 'userProfile');
        // Route::post('/profileimg','update_profileIMG');
        // Route::get('/show/posts','show_posts');
        // Route::post('/store-fcm-token', 'FCMTokenController');
        // Route::get('/show/seller/notifications','show_seller_notifications');
        // Route::get('/show/buyer/notifications','show_buyer_notifications');
        // Route::get('/show/seller/confirm-notifications','seller_confirm_notification');
        // Route::get('/show/buyer/confirm-notifications','buyer_confirm_notification');
        // Route::get('/show/buyer/responses','buyer_responses');


    });
});


Route::get('/phone-verify', [ResetPasswordController::class,'phone_verify'])->name('phone-confirm');

Route::post('/phone-verify', [ResetPasswordController::class,'phone_verify_process'])->name('phone-verify');


Route::get('/forgot-password', [ResetPasswordController::class, 'forgot_password'])->name('password.request');

Route::post('/forgot-password', [ResetPasswordController::class,'forgot_password_process'])->name('password.phone');

Route::middleware('password_reset')->group(function(){

    Route::get('/code', [ResetPasswordController::class,'code_view'])->name('code.confirm');
    
    Route::post('/code', [ResetPasswordController::class,'code_process'])->name('code.verify');
    
    
    Route::get('/new-password',[ResetPasswordController::class,'new_password'])->name('change-password');
    
    Route::post('/new-password',[ResetPasswordController::class,'new_password_process'])->name('reset-password');
});

// Route::get('/reset-password/{token}', function (string $token) {
//     return view('authentications.new-password', ['token' => $token]);
// })->middleware('guest')->name('password.reset');

// Route::post('/reset-password', function (Request $request) {

//     $request->validate([
//         'token' => 'required',
//         'phone_number' => 'required|string',
//         'password' => 'required|min:8|confirmed',
//     ]);
 
//     $status = Password::reset(
//         $request->only('phone_number', 'password', 'password_confirmation', 'token'),
//         function (User $user, string $password) {
//             $user->forceFill([
//                 'password' => Hash::make($password)
//             ])->setRememberToken(Str::random(60));
 
//             $user->save();
 
//             event(new PasswordReset($user));
//         }
//     );
 
//     return $status === Password::PASSWORD_RESET
//                 ? redirect()->route('login')->with('status', __($status))
//                 : back()->withErrors(['phone_number' => [__($status)]]);

// })->middleware('guest')->name('password.update');

