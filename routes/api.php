<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\Content\ContentLandingController;
use App\Http\Controllers\Content\ContentReservationsController;
use App\Http\Controllers\EmailSendingController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\SeatController;
use App\Models\Reservation;
use App\Models\Seat;
use Faker\Core\DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Public routes
//Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::get('pages/landing', [ContentLandingController::class, 'index']);
Route::get('email/send', [EmailSendingController::class, 'sendEmail']);


// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('logout', [AuthController::class, 'logout']);

    //Route::resource('reservations', ReservationController::class);
    Route::get('pages/reservations', [ContentLandingController::class, 'indexReservations']);

    Route::post('reservations', [ReservationController::class, 'store']);
    Route::get('reservations/search/{name}', [ReservationController::class, 'search']);
});


/*Route::middleware('auth:sanctum')->get('/user', function () {
    return $request->user();
});*/
