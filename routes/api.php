<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('seats', function ()
{
    return Seat::all();
});

Route::post('reservations/create',function (){
    $faker = Faker\Factory::create();
    return Reservation::create(
        [
            'name' => 'Davca Sedlar',
            'email' => 'davca@mail.com',
            'tel'=> '555222555',
            'note' => 'realne nechce na ples',
            'stand' => '5',
            'price_all'=> '525',
            'status' => 1,
            'date_reservation' => $faker->dateTime(),
            'date_payment' => $faker->dateTime()
        ]
    );
});