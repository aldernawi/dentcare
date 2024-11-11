<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\doctor\CardController;
use App\Http\Controllers\doctor\ProfileController;
use App\Http\Controllers\doctor\DashboardController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;







Route::group([
    'prefix' => LaravelLocalization::setLocale() . '/doctor',
    'as' => 'doctor.',
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:doctor']
], function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');


    Route::resource('card', CardController::class)->except(['store']);
    Route::resource('profile', ProfileController::class)->only(['index', 'update']);
    Route::get('logout', function () {
        Auth::logout();

        return redirect()->route('home');
    })->name('logout');
});
