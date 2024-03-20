<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::post('/register', [\App\Http\Controllers\RegisterController::class, 'register'])->name('registration');
    Route::post('/login', [\App\Http\Controllers\LoginController::class, 'auth'])->name('auth');
});

Route::middleware('auth')->group(function () {
    Route::get('/logout', [\App\Http\Controllers\LoginController::class, 'logout'])->name('logout');

    Route::middleware('user')->group(function () {
        Route::prefix('/user')->group(function () {
            Route::post('/application', [\App\Http\Controllers\User\ApplicationController::class, 'store'])->name('user.application.store');
        });
    });

    Route::middleware('admin')->group(function () {
        Route::prefix('/admin')->group(function () {
            Route::prefix('/application')->group(function () {
                Route::put('/admin/application/{application}', [\App\Http\Controllers\Admin\AdminApplicationController::class, 'update'])->name('admin.applications.update');
            });
        });
    });
});

