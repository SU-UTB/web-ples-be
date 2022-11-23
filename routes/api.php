<?php

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

Route::get('seats', [SeatController::class, 'index']);


/* Route::get('reservations', [ReservationController::class, 'index']);
Route::post('reservations/create', [ReservationController::class, 'store']); */
Route::resource('reservations', ReservationController::class);
Route::get('reservations/search/{name}', [ReservationController::class, 'search']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('doc', function () {
    $path = storage_path() . "/api-docs/api-docs.json"; // ie: /var/www/laravel/app/storage/json/filename.json

    $json = json_decode(file_get_contents($path), true); 
    return $json;
});