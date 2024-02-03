<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\StaticsController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TopController;
use App\Models\Student;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [AuthenticatedSessionController::class, 'create'])->name('auth.login');

Route::middleware('auth')->group(function () {
    Route::controller(TopController::class)->group(function () {
        Route::get('/top', 'index')->name('tops.index');
        Route::post('/top/change-counter', 'changeCounter')->name('change-counter');
    });

    Route::resource('students', StudentController::class)->only(['create', 'store', 'destroy']);

    Route::controller(SeatController::class,)->group(function () {
        Route::get('/top/seat', 'showSeat')->name('seats.index');
        Route::post('/top/seat', 'storeSeat')->name('seats.store');
        Route::get('/top/seat/assign/{id}', 'showAssign')->name('seats.assign.index');
        Route::post('/top/seat/assign/', 'storeAssign')->name('seats.assign.store');
    });

    Route::get('/top/statics', [StaticsController::class, 'index'])->name('statics.index');

    Route::controller(MyPageController::class)->group(function () {
        Route::get('top/mypage', 'index')->name('mypage.index');
        Route::delete('top/mypage/destroy', 'destroy')->name('mypage.destroy');
    });
});

require __DIR__.'/auth.php';
