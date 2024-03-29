<?php

namespace App\Http\Controllers;

use App\Models\Maker;
use App\Models\MakerReservation;
use App\Models\MakerService;
use App\Models\MakerTime;
use Illuminate\Http\Request;


class MakerController extends Controller
{
    private array $times = [
        "1400" => [],
        "1430" => [],
        "1500" => [],
        "1530" => [],
        "1600" => [],
        "1630" => [],
        "1700" => [],
        "1730" => [],
        "1800" => [],
        "1830" => [],
    ];

    public function index()
    {
        $makers = Maker::all();
        $makerServices = MakerService::all();
        $makerTimes = array();
        foreach ($makers as $maker) {
            $makerTimes[$maker->id] = array();
        }
        foreach (MakerTime::all() as $mt) {
            array_push($makerTimes[$mt->maker_id], $mt->time);
        }
        $availableTimes = $this->times;

        foreach ($makers as $maker) {
            $usedMakerTimes = $makerTimes[$maker->id];

            foreach ($availableTimes as $key => $timeSpan) {
                if (in_array($key, $usedMakerTimes)) {
                    continue;
                } else {
                    array_push($availableTimes[$key], $maker->id);
                }
            }
        }

        $data = [
            'makers' => $makers->toArray(),
            'availableTimes' => $availableTimes,
            'makerServices' => $makerServices->toArray(),
        ];
        return response()->json($data, 200);
    }

    public function store(Request $request)
    {

        $request->validate([
            'maker' => 'required',
            'time' => 'required',
            'service' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'consent' => 'required'
        ]);

        $makerId = (int)$request->input('maker');

        if ($makerId === 0) {
            return response()->json([
                "error" => "Omlouváme se, nastala chyba a rezervace se bohužel nezdařila, zvolte prosím jinou obsluhu.",
            ], 400);
        }

        $time = (string)$request->input('time');

        $makerTimes = MakerTime::all();

        foreach ($makerTimes as $makerTime) {
            if ((int)$makerTime->maker_id === $makerId && (string)$makerTime->time === $time) {
                $maker = Maker::find($makerId)->name;
                $time = str_replace('00', ':00', $time);
                $time = str_replace('30', ':30', $time);
                return response()->json([
                    "error" => "Rezervace u vizážistky \"$maker\" na $time je již bohužel vytvořena, prosím zvolte jiný čas.",
                ], 400);
            }
        }

        $reservedTime = MakerTime::create([
            'maker_id' => $makerId,
            'time' => $time
        ]);

        $reservation = MakerReservation::create([
            'maker' => $makerId,
            'time' => $time,
            'service' => $request->input('service'),
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'consent' => (int)$request->input('consent')

        ]);

        $data = ['reservation' => $reservation, 'reservedTime' => $reservedTime];

        EmailSendingController::sendEmail(EmailContent::ReserveMaker, $data);

        return response()->json($data, 200);

    }

    public function cancel(Request $request, $id)
    {
        $reservation = MakerReservation::find($id);

        $makerTime = MakerTime::where([
            ['maker_id', '=', $reservation->maker],
            ['time', '=', $reservation->time],

        ])->get()->first();


        MakerTime::destroy($makerTime->id);
        $this->destroy($id);
        return AdministrationController::makers();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return MakerReservation::destroy($id);
    }

}
