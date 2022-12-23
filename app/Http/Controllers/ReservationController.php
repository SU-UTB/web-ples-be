<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Seat;
use DateTime;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="Kodementor Api Documentation",
 *     description="Kodementor Api Documentation",
 *     @OA\Contact(
 *         name="Vijay Rana",
 *         email="info@kodementor.com"
 *     ),
 *     @OA\License(
 *         name="Apache 2.0",
 *         url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *     )
 * ),
 * @OA\Server(
 *     url="/api/v1",
 * ),
 */
class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *    path="/articles",
     *    operationId="index",
     *    tags={"Articles"},
     *    summary="Get list of articles",
     *    description="Get list of articles",
     *    @OA\Parameter(name="limit", in="query", description="limit", required=false,
     *        @OA\Schema(type="integer")
     *    ),
     *    @OA\Parameter(name="page", in="query", description="the page number", required=false,
     *        @OA\Schema(type="integer")
     *    ),
     *    @OA\Parameter(name="order", in="query", description="order  accepts 'asc' or 'desc'", required=false,
     *        @OA\Schema(type="string")
     *    ),
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example="200"),
     *             @OA\Property(property="data",type="object")
     *          )
     *       )
     *  )
     */
    public function index()
    {
        return Reservation::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {

        //   $request->validate([
        //      'name' => 'required'
        // ]);
        $stand = $request->input('stand') ?? 0;
        $price = 500;
        $reservation = Reservation::create(
            [
                'name' =>  $request->input('name'),
                'email' => $request->input('email'),
                'tel' => $request->input('tel'),
                'note' => $request->input('note'),
                'stand' => $stand,
                'price_all' => $stand * $price,
                'status' => 1,
                'date_reservation' => Carbon::now(),
                'date_payment' => Carbon::now()
            ]
        );

        $seats = Seat::findMany($request->input('seats'))->toArray();
        $this->updateSeats($seats, $reservation->id);

        $data = ['reservation' => $reservation, 'seats' => $seats];

       // $this->sendEmail();

        return view("reserved", $data);
    }

    public function sendEmail()
    {
        $data = array('name'=>"Virat Gandhi");
        Mail::send(['text' => 'mail'], $data, function ($message) {
            $message->to('sedlar@sutb.com', 'Tutorials Point')->subject('Laravel Basic Testing Mail');
            $message->from('sedlar@sutb.com', 'DS');
        });
    }

    private function updateSeats($seats, $reservationId)
    {
        foreach ($seats as $seatObj) {
            $seat = Seat::find($seatObj['id']);
            $seat->rezervace = $reservationId;
            $seat->save();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Reservation::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $reservation = Reservation::find($id);
        $reservation->update($request->all());
        return $reservation;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Reservation::destroy($id);
    }


    /**
     * Search with a name.
     *
     * @param  str  $name
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
        return Reservation::where('name', 'like', '%' . $name . '%')->get();
    }

    public function reservationTest()
    {
        $seats = Seat::all()->toArray();
        return view('reservation', ["seats" => $seats]);
    }
}
