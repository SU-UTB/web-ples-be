<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Seat;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class AdministrationController extends Controller
{
    public function dashboard()
    {
        $data = [];
        return view('administration/dashboard', ["data" => $data]);
    }
    public function reservations()
    {

        $seats = Seat::whereNotNull('rezervace')->get()->toArray();
        //   dd($seats);
        $reservations = Reservation::all()->toArray();

        $data = [];
        foreach ($reservations as $reservation) {
            $id = $reservation['id'];
            $filteredArray = array_filter($seats, function ($item) use ($id) {
                return $item["rezervace"] === $id;
            });
            $aliases = array_map(function ($seat) {
                return $seat['alias'];
            }, $filteredArray);
            $reservation['seats'] = $aliases;

            array_push($data, $reservation);
        }
        return view('administration/reservations', ["reservations" => $data]);
    }
}
