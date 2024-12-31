<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShowController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CrudController;

// Login routes
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', [ShowController::class, 'daftar'], function () {
    return view('home');
});

Route::get('/show', [ShowController::class, 'show'])->name('show');

Route::get('/show/{show_id}', [ShowController::class, 'detail'])->name('shows.detail');

Route::resource('/tabel', CrudController::class);

Route::get('/pro-dashboard',[ShowController::class, 'jumlahTayangan'], function () {
    return view('dashboard');
});

Route::get('/eks-dashboard',[ShowController::class, 'yearcount'], function () {
    return view('page');
});


