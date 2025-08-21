<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LogInController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('login');





Route::post('/logout', [LogInController::class, 'destroy'])->name('logout');

Route::post('/login', [LogInController::class, 'index'])->name('login.user');
Route::post('/register',[RegistrationController::class, 'store'])->name('register');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'create'])->name('dashboard');
});