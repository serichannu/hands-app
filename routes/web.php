<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/top', function () {
    return view('hands/top');
})->middleware(['auth'])->name('top');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/top/seat', function () {
    return view('hands/seats/create_seat');
})->middleware(['auth'])->name('seat');

Route::get('/top/seat/number', function () {
    return view('hands/seats/number_sorting');
})->middleware(['auth'])->name('number');

Route::get('/top/aggregation', function () {
    return view('hands/aggregations/index');
})->middleware(['auth'])->name('aggregation');


require __DIR__.'/auth.php';
