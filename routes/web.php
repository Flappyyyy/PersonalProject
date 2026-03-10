<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AuthController;

// ─── Public Auth Routes ──────────────────────────────────────────────────────

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class , 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class , 'login']);
    Route::get('/register', [AuthController::class , 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class , 'register']);
});

Route::post('/logout', [AuthController::class , 'logout'])->name('logout');

// ─── Protected Routes (require login) ───────────────────────────────────────

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class , 'index'])->name('dashboard');

    Route::group(['prefix' => 'clients', 'as' => 'clients.'], function () {
            Route::get('/', [ClientController::class , 'index'])->name('index');
            Route::post('/', [ClientController::class , 'store'])->name('store');
            Route::put('/{client_id}', [ClientController::class , 'update'])->name('update');
            Route::delete('/{client_id}', [ClientController::class , 'destroy'])->name('destroy');
        }
        );

        Route::group(['prefix' => 'payments', 'as' => 'payments.'], function () {
            Route::post('/{client_id}', [PaymentController::class , 'update'])->name('update');
        }
        );    });
