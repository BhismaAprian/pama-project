<?php

use App\Http\Controllers\AttributeControllers;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RoomControllers;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
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

Route::get('/', [DashboardController::class, 'dashboard'])->name('home');

Route::get('/login', function () {
    return view('pages.login');
});
Route::middleware(['auth'])->group(function () {

    Route::delete('/history/{history}', [HistoryController::class, 'destroy'])->name('history.destroy');
    Route::resource('/user', UserController::class);
});
Route::get('/history', [HistoryController::class, 'index'])->name('history.index');


// Route::resource('/rooms', RoomControllers::class);
// Route::resource('/attributes', AttributeControllers::class);
// Route::get('/history', [HistoryController::class, 'index'])->name('history.index');
// Route::delete('/history/{history}', [HistoryController::class, 'destroy'])->name('history.destroy');
// Route Auth


Route::resource('/reservation', ReservationController::class);

Route::resource('/rooms', RoomControllers::class);
Route::resource('/attributes', AttributeControllers::class);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
