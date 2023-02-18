<?php

namespace App\Http\Controllers;

use App\Models\Maker;
use App\Models\MakerService;
use App\Models\MakerTime;


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
            'makers' => $makers->toJson(JSON_UNESCAPED_UNICODE),
            'availableTimes' => json_encode($availableTimes, JSON_UNESCAPED_UNICODE),
            'makerServices' => $makerServices->toJson(JSON_UNESCAPED_UNICODE),
        ];
        return view('makers', $data);
    }
}
