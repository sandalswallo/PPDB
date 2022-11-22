<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    DashboardController,
    SiswaController,
    JurusanController
};

Route::get('/', function () {
    return view('home.welcome');
});

// Route Login
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/postlogin', [AuthController::class, 'postlogin'])->name('postlogin');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
// Route Register
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/simpanRegister', [AuthController::class, 'simpanRegister'])->name('simpanRegister');

// Route Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard'); 

// Route Siswa
Route::get('/siswa/data', [SiswaController::class, 'data'])->name('siswa.data');
Route::resource('/siswa', SiswaController::class);

/// Route Tempat
// Route::get('/tempat/data', [TempatController::class, 'data'])->name('tempat.data');
// Route::resource('/tempat', TempatController::class);

// Route jurusan
Route::get('/jurusan/data', [JurusanController::class, 'data'])->name('jurusan.data');
Route::resource('/jurusan', JurusanController::class);
