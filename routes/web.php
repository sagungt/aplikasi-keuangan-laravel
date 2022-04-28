<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

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
    Route::get('/email/verify', [LoginController::class, 'verify'])
        ->name('verification.notice');

    Route::post('/email/verification-notification', [LoginController::class, 'resend'])
        ->middleware('throttle:6,1')
        ->name('verification.resend');
    
    Route::get('/email/verify/{id}/{hash}', [LoginController::class, 'verification'])
        ->middleware('signed')
        ->name('verification.verify');
});

Route::middleware('verified')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');
    Route::post('/logout', [LoginController::class, 'logout']);
});

