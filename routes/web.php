<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'index')->name('login');
    Route::post('/login', 'signIn')->name('signIn');
    Route::get('/sign-up', 'signUp')->name('sign-up');
    Route::get('/forgot', 'forgot')->name('forgot');
    Route::get('/reset', 'reset')->name('reset');
});

Route::get('/', HomeController::class)->name('home');
