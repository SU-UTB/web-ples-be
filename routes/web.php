<?php

use App\Http\Controllers\AdministrationController;
use App\Http\Controllers\Content\ContentLandingEditController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('test/reservation' , [ReservationController::class, 'reservationTest']);

Route::middleware('auth')->group(function () {

    Route::get('/admin', [AdministrationController::class, 'dashboard'])->name('dashboard');
    Route::get('/admin/reservations', [AdministrationController::class, 'reservations'])->name('reservations');
    Route::get('/admin/content/landing', [ContentLandingEditController::class, 'index'])->name('landingEdit');
    Route::put('/admin/content/landing/{id}', [ContentLandingEditController::class, 'updateContent'])->name('updateLandingContent');

    Route::post('/admin/reservations', [ReservationController::class, 'store']);
    Route::get('/admin/reservations/{id}', [ReservationController::class, 'cancel'])->name('cancelReservation');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
