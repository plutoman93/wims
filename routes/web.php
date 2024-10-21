<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/admin-dashboard', function () {
        return view('admin-dashboard');
    })->name('admin.dashboard'); // ตั้งชื่อให้เป็น admin.dashboard
});


Route::get('/home',[UserController::class,'index']);
