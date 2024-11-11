<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath',]
], function () {


    Route::group([
        'middleware' => ["auth:web"]
    ], function () {



        Route::resource('card', CardController::class)->except(['store']);
        Route::post('card/store/{id}', [CardController::class, 'store'])->name('card.store');

        Route::resource('ratings', RatingController::class)->except(['store']);
        Route::post('ratings/store/{id}', [RatingController::class, 'store'])->name('ratings.store');
    });


    Route::resource('services', ServiceController::class);
    Route::resource('contact', ContactController::class);



    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Auth::routes();



    Route::get('logout', function () {
        Auth::logout();

        return redirect()->route('home');
    })->name('logout');
});
