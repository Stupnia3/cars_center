<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [\App\Http\Controllers\UserCardController::class, 'index'])->name('welcome');
Route::get('/users/{id}', [\App\Http\Controllers\UserController::class, 'show'])->name('user.show');
Route::get('/search', [\App\Http\Controllers\UserCardController::class, 'search'])->name('search');
Route::post('/get-closest-users', [\App\Http\Controllers\UserCardController::class, 'getClosestUsers'])->name('get-closest-users');
Route::get('/search/go', [\App\Http\Controllers\UserController::class, 'search_click'])->name('search_click');




Route::middleware('guest.required')->group(function () {
    Route::get('/register', function () {
        return view('register');
    })->name('register');
    Route::get('/login', function () {
        return view('login');
    })->name('login');
});

Route::middleware(['user_status', 'auth'])->group(function () {
    Route::prefix('/user')->group(function () {
        Route::get('', [\App\Http\Controllers\AccountController::class, 'index'])->name('user');

        Route::put('/user/profile/update', [\App\Http\Controllers\User\ProfileController::class, 'update'])->name('user.profile.update');
        Route::prefix('/application')->group(function () {
            Route::get('', [\App\Http\Controllers\User\ApplicationController::class, 'index'])->name('user.application.index');
            Route::get('/create', [\App\Http\Controllers\User\ApplicationController::class, 'create'])->name('user.application.create');
        });
    });
});


Route::middleware(['auth', 'admin'])->group(function () {
    Route::prefix('/admin')->group(function () {
        // Страница администратора
        Route::get('', function () {
            return view('admin.index');
        })->name('admin');
        Route::get('/admin/add-admin', function () {
            return view('admin.add-admin');
        })->name('add-admin');

        Route::post('/admin/users', [\App\Http\Controllers\Admin\UserAdminController::class, 'store'])->name('admin.users.store');


        // Маршрут для обновления статуса пользователя
        Route::put('/users/{user}', [\App\Http\Controllers\Admin\AdminApplicationController::class, 'update'])->name('admin.users.update');

        // Маршруты для заявок (если они нужны)
        Route::prefix('/application')->group(function () {
            Route::get('', [\App\Http\Controllers\Admin\AdminApplicationController::class, 'index'])->name('admin.application.index');
        });
    });
});
