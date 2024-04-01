<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index']);
Route::post('/sendWhatsapp/{id}', [UserController::class, 'sendWhatsapp'])->name('sendWhatsapp');
Route::get('/portfolio/{username}', [UserController::class, 'show'])->name('user.show');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/post', PostController::class);
    
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.updateProfile');
    Route::post('/updatePassword', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
    
    Route::post('/profiling', [ProfileController::class, 'profiling'])->name('profile.profiling');
    
    Route::post('/selectProvince', [ProfileController::class, 'selectProvince'])->name('selectProvince');
    Route::post('/selectRegency', [ProfileController::class, 'selectRegency'])->name('selectRegency');

    Route::get('/getDataUserForChart', [DashboardController::class, 'getDataUserForChart']);
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::post('/store', [UserController::class, 'store'])->name('user.store');
    Route::delete('/destroy/{id}', [UserController::class, 'destroy'])->name('user.destroy');
});

Route::get('/login', [AuthController::class, 'index'])->name('auth.index');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/register', [AuthController::class, 'registerStore'])->name('auth.registerStore');
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');

