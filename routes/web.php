<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivationController;

Route::get('/', [ActivationController::class, 'index'])->name('index');
Route::get('/register', [ActivationController::class, 'registerForm'])->name('register-form');

Route::post(
    '/register-receipt',
    [ActivationController::class, 'storeReceipt']
)->name('register-receipt');
