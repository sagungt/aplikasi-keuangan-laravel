<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
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

/*
|--------------------------------------------------------------------------
| Route group priority
|--------------------------------------------------------------------------
| 1. Prefix
| 2. Controller
| 3. Middleware
|
*/

Route::get('/', function () {
    return redirect()->route('dashboard.index');
});

Route::controller(LoginController::class)->group(function () {
    Route::middleware(['guest'])->group(function () {
        Route::get('/login', 'index')
            ->name('login');
        Route::post('/login', 'authenticate')
            ->name('authenticate');
        Route::get('/forgot-password', 'requestPassword')
            ->name('password.request');
        Route::post('/forgot-password', 'forgotPassword')
            ->name('password.email');
        Route::get('/reset-password/{token}', 'resetPassword')
            ->name('password.reset');
        Route::post('/reset-password', 'reset')
            ->name('password.update');
    });

    Route::middleware(['auth'])->group(function () {
        Route::middleware(['signed'])->group(function () {
            Route::get('/email/verify/{id}/{hash}', 'verification')
                ->name('verification.verify');
        });

        Route::middleware(['throttle:6,1'])->group(function () {
            Route::post('/email/verification-notification', 'resend')
                ->name('verification.resend');
        });

        Route::get('/email/verify', 'verify')
            ->name('verification.notice');
        Route::post('/logout', 'logout')
            ->name('logout');
    });
});

Route::controller(RegisterController::class)->group(function () {
    Route::middleware(['guest'])->group(function () {
        Route::get('/register', 'index')
            ->name('register');
        Route::post('/register', 'store')
            ->name('store');
    });
});

Route::prefix('dashboard')->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::middleware(['verified'])->group(function () {
            Route::get('/', 'index')
                ->name('dashboard.index');
        });
    });

    // unclean routes 
    
    // dumy user
    Route::get('/user/data', function () {
        return view('dashboard.tools.export-import');
    });
    Route::get('/user/private', function () {
        return view('dashboard.tools.export-import');
    });
    
    Route::middleware(['verified'])->group(function () {
        Route::resource('user', UserController::class)
            ->only(['show', 'update', 'destroy']);
    });

    // dumy loan
    Route::get('/loan', [LoanController::class, 'request']);
    Route::get('/loan/all', function () {
        return view('dashboard.tools.export-import');
    });

    // dumy admin
    Route::get('/admin/users', [UserController::class, 'index']);
    Route::post('/admin/users', [UserController::class, 'store']);
    Route::get('/admin/users/{user}', [UserController::class, 'show']);
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy']);
    Route::get('/admin/loans', function () {
        return view('dashboard.tools.export-import');
    });

    // dumy export import
    Route::get('/export-import', function () {
        return view('dashboard.tools.export-import');
    });
});