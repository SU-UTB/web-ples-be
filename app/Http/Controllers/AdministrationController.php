<?php

namespace App\Http\Controllers;

use App\Models\AvailableStands;
use App\Models\Reservation;
use App\Models\Seat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class AdministrationController extends Controller
{
    public function dashboard()
    {
        $takenSeats = count(Seat::where('rezervace', '!=', null)->get());
        $freeSeats = count(Seat::where('rezervace', '=', null)->get());
        $freeWithRautSeats = count(Seat::where('rezervace', '=', null)->where('typ', '=', 'raut')->get());
        $freeNormalSeats = count(Seat::where('rezervace', '=', null)->where('typ', '=', 'normal')->get());
        $priceAll = array_sum(array_map(function ($r) {
            return $r['price_all'];
        }, Reservation::all()->toArray()));
        $availableStands = AvailableStands::find(1);
        return view('dashboard', [
            "freeSeats" => $freeSeats,
            "takenSeats" => $takenSeats,
            "moneyRaised" => $priceAll,
            "availableStands" => $availableStands->count,
            "freeWithRautSeats" => $freeWithRautSeats,
            "freeNormalSeats" => $freeNormalSeats
        ]);
    }
    public  function reservations()
    {
        $data = $this->getReservationsData();
        return view('administration/reservations', ["reservations" => $data, "search" => ""]);
    }

    public  function reservationsSearch(Request $request)
    {
        $search = $request->input('search');

        if ($search == '') {
            return $this->reservations();
        } else {

            $data = $this->getReservationsData();

            $data = array_filter(
                $data,
                function ($var) use ($search) {
                    return AdministrationController::array_any($var['seats'], function ($alias)  use ($search) {
                        return str_contains(strtolower($alias), strtolower($search));
                    });
                }
            );
            return view('administration/reservations', ["reservations" => $data, "search" => $search]);
        }
    }


    private static function array_any(array $array, callable $fn)
    {
        foreach ($array as $value) {
            if ($fn($value)) {
                return true;
            }
        }
        return false;
    }

    private function getReservationsData()
    {
        $seats = Seat::whereNotNull('rezervace')->get()->toArray();
        $reservations = Reservation::all()->toArray();
        $data = [];
        foreach ($reservations as $reservation) {
            $id = $reservation['id'];
            $reservation['date_payment'] = Carbon::parse($reservation['date_payment'])->addHour()->toDateTimeString();
            $filteredArray = array_filter($seats, function ($item) use ($id) {
                return $item["rezervace"] === $id;
            });
            $aliases = array_map(function ($seat) {
                return $seat['alias'];
            }, $filteredArray);
            $reservation['seats'] = $aliases;

            array_push($data, $reservation);
        }
        return $data;
    }
}
