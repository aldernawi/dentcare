<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\CardController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\DoctorController;
use App\Http\Controllers\admin\ContactController;
use App\Http\Controllers\admin\ServiceController;

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\DoctorScheduleController;
use App\Http\Controllers\admin\UserStatusController;
use App\Models\UserStatus;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;







Route::group([
    'prefix' => LaravelLocalization::setLocale() . '/admin',
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:admin']
], function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');


    Route::resource('adminServices', ServiceController::class);
    Route::resource('admins', AdminController::class);
    Route::resource('users', UserController::class);
    Route::resource('doctors', DoctorController::class);
    Route::resource('schedules', DoctorScheduleController::class);
    Route::resource('adminReservations', CardController::class);
    Route::get('AllDoctorsSchedule', [DoctorScheduleController::class, 'DoctorsSchedule']);
    Route::resource('Admincontact', ContactController::class);
    Route::resource('AdminStatus', UserStatusController::class);
    Route::get('cvDownload/{id}', [DoctorController::class, 'getDownload'])->name('cvDownload');
    Route::get('Adminlogout', function () {
        Auth::logout();

        return redirect()->route('home');
    })->name('Adminlogout');
});
