<?php

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

Route::get('/', function () {
    return view('auth.login');
});
Route::middleware('auth')->group(function () {

Route::get('/top', [TopController::class, 'index'])->name('tops.index');
Route::get('top/student', [StudentController::class, 'index'])->name('students.index');
Route::post('top/student', [StudentController::class, 'store'])->name('students.store');
Route::get('/top/seat', [SeatController::class, 'showSeat'])->name('seats.index');
Route::post('/top/seat', [SeatController::class, 'storeSeat'])->name('seats.store');
Route::get('/top/seat/assign/{id}', [SeatController::class, 'showAssign'])->name('seats.assign.index');
Route::post('/top/seat/assign/', [SeatController::class, 'storeAssign'])->name('seats.assign.store');
Route::get('/top/statics', [StaticsController::class, 'index'])->name('statics.index');
Route::controller(MyPageController::class)->group(function () {
    Route::get('top/mypage', 'index')->name('mypage.index');
//     Route::get('top/mypage/edit', 'update')->name('mypage.update');
//     Route::put('top/mypage/', '')->name('mypage.');

});
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
