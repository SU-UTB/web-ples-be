<?php

namespace App\Http\Controllers;

use App\Models\AvailableStands;
use App\Models\Maker;
use App\Models\MakerReservation;
use App\Models\Reservation;
use App\Models\Seat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;

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
            }, Reservation::all()->toArray())) - 5500;
        // 5500 free listky
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

    public static function reservations()
    {
        $data = AdministrationController::getReservationsData();
        return Inertia::render('Admin/Reservations', ['reservations' => $data, 'search' => ""]);

    }

    public static function makers()
    {
        $data = AdministrationController::getMakersReservationsData();
        return view('administration/makers', ["reservations" => $data, "search" => ""]);
    }

    public function reservationsSearch()
    {
        $data = AdministrationController::getReservationsData();
        return Inertia::render('Admin/Reservations', ['reservations' => $data, 'search' => ""]);
    }
    
    public function makersSearch(Request $request)
    {
        $search = $request->input('search');

        if ($search == '') {
            return AdministrationController::makers();
        } else {

            $data = AdministrationController::getMakersReservationsData();

            $data = array_filter(
                $data,
                function ($var) use ($search) {
                    return str_contains(strtolower($var['name']), strtolower($search));
                }
            );
            return view('administration/makers', ["reservations" => $data, "search" => $search]);
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

    private static function getReservationsData()
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

    private static function getMakersReservationsData()
    {
        $makers = Maker::all();
        $reservations = MakerReservation::all()->toArray();

        $data = [];
        foreach ($reservations as $reservation) {
            $maker = $makers->where('id', $reservation['maker'])->first();
            $reservation['maker'] = $maker->name;
            $time = $reservation['time'];
            $time = str_replace('00', ':00', $time);
            $time = str_replace('30', ':30', $time);
            $reservation['time'] = $time;

            array_push($data, $reservation);
        }
        return $data;

    }
}
