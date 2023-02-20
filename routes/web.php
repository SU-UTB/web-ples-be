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

Route::middleware('auth')->group(function () {

    Route::get('/admin', [AdministrationController::class, 'dashboard'])->name('dashboard');
    Route::get('/admin/reservations', [AdministrationController::class, 'reservations'])->name('reservations');
    Route::get('/admin/makers', [AdministrationController::class, 'makers'])->name('maker');
    Route::post('/admin/reservations/search', [AdministrationController::class, 'reservationsSearch'])->name('search-reservations');
    Route::post('/admin/makers/search', [AdministrationController::class, 'makersSearch'])->name('search-makers');
    Route::get('/admin/content/landing', [ContentLandingEditController::class, 'indexLanding'])->name('landingEdit');
    Route::get('/admin/content/landing/contacts', [ContentLandingEditController::class, 'indexContacts'])->name('contactsEdit');
    Route::get('/admin/content/landing/tickets', [ContentLandingEditController::class, 'indexTickets'])->name('ticketsEdit');
    Route::put('/admin/content/landing/{id}', [ContentLandingEditController::class, 'updateContent'])->name('updateLandingContent');
    Route::put('/admin/content/landing/contacts/{id}', [ContentLandingEditController::class, 'updateContact'])->name('updateContact');
    Route::post('/admin/content/landing/tickets', [ContentLandingEditController::class, 'updateTicketsDate'])->name('updateTicketsDate');

    Route::get('test/reservation' , [ReservationController::class, 'reservationTest'])->name('reservationTest');
    Route::post('/admin/reservations', [ReservationController::class, 'store']);
    Route::get('/admin/reservations/{id}', [ReservationController::class, 'cancel'])->name('cancelReservation');
    Route::get('/admin/makers/{id}', [\App\Http\Controllers\MakerController::class, 'cancel'])->name('cancelMakerReservation');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
