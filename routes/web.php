<?php

use App\Http\Controllers\MyPageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\StaticsController;
use App\Http\Controllers\TopController;
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

Route::get('/top', [TopController::class, 'index'])->middleware(['auth'])->name('top.index');
// routes/web.php

Route::get('/top/seat', [SeatController::class, 'showSeat'])->middleware(['auth'])->name('seats.index');
Route::post('/top/seat', [SeatController::class, 'storeSeat'])->middleware(['auth'])->name('storeSeat');
Route::get('/top/seat/assign/{id}', [SeatController::class, 'showAssign'])->middleware(['auth'])->name('seats.assign');
Route::post('/top/seat/assign', [SeatController::class, 'storeAssign'])->middleware(['auth'])->name('storeAssign');
Route::get('/top/statics', [StaticsController::class, 'index'])->middleware(['auth'])->name('statics.index');
Route::controller(MyPageController::class)->group(function () {
    Route::get('top/mypage', 'index')->middleware(['auth'])->name('mypages.index');
//     Route::get('top/mypage/edit', 'update')->middleware(['auth'])->name('mypage.update');
//     Route::put('top/mypage/', '')->middleware(['auth'])->name('mypage.');

});


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });


require __DIR__.'/auth.php';
