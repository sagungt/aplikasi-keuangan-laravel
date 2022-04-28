<?php

use App\Http\Controllers\TestController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
    
    Route::get('/login', [LoginController::class, 'index'])
        ->name('login');
    Route::get('/register', [RegisterController::class, 'index'])
        ->name('register');
    Route::post('/login', [LoginController::class, 'authenticate']);
    Route::post('/register', [RegisterController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::get('/email/verify', function () {
        return (auth()->user()->hasVerifiedEmail())
            ? redirect('dashboard')
            : view('auth.verify');
    })
        ->name('verification.notice');

    Route::post('/email/verification-notification', function (Request $request) {
        $request
            ->user()
            ->sendEmailVerificationNotification();
        return back()
            ->with('Success', 'Verification link sent!');
    })
        ->middleware('throttle:6,1')
        ->name('verification.resend');
    
    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request
            ->fulfill();
        
        return redirect('/dashboard');
    })
        ->middleware('signed')
        ->name('verification.verify');
});

Route::middleware('verified')->group(function () {
    // * change controller
    Route::get('/dashboard', [TestController::class, 'dashboard'])
        ->name('dashboard');
    Route::post('/logout', [LoginController::class, 'logout']);
});

