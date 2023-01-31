<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Seat;
use DateTime;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="SU Ples - Api Documentation",
 *     description="Api Documentation for UTB Representative Ball",
 *     @OA\Contact(
 *         name="Sedlar David",
 *         email="sedlar@sutb.cz"
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
     *    path="/api/reservations",
     *    operationId="index",
     *    tags={"Reservations"},
     *    summary="Get list of reservations",
     *    description="Get list of reservations",
     *   @OA\Response(response=200, description="OK"),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   @OA\Response(response=404, description="Not Found")
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
    /**
     * @OA\Post(
     *   tags={"Reservations"},
     *   path="/api/reservations",
     *   summary="Creates a reservation",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="email",
     *                     type="string"
     *                 ),     
     *                @OA\Property(
     *                     property="tel",
     *                     type="integer"
     *                 ),                 
     *                   @OA\Property(
     *                     property="note",
     *                     type="string"
     *                 ),    
     *                               @OA\Property(
     *                     property="stand",
     *                     type="integer"
     *                 ),         
     *                     @OA\Property(
     *                     property="seats",
     *                     type="integer"
     *                 ),
     * @OA\Property(
     *      type="array",
     *      @OA\Items(
     *          type="array",
     *          @OA\Items()
     *      ),
     *      description="List of Seat ids"
     * ),
     *                 example={"name": "David Sedlar", "email": "sedlar@sutb.cz", "tel": 555222555, "note" :"Popici ples, chci celej stul...","stand" :3, "seats" : {2, 3,5}}
     *             )
     *         )
     *     ),
     *   @OA\Response(response=200, description="OK"),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   @OA\Response(response=404, description="Not Found")
     * )
     */

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'tel' => 'required',
            'consent' => 'required'
        ]);
        $seatsData = json_decode($request->input('seats'), true);

        if ($request->input('stand') == 0 && count($seatsData ?? []) == 0) {
            return response()->json([
                'message' => 'Either seats or stand tickets must be filled!'
            ], 400);
        }

        $stand = $request->input('stand') ?? 0;

        $seats = Seat::findMany($seatsData)->toArray();

        $totalPrice = $this->getStandPrice($stand) + $this->getSeatsPrice($seats);

        $reservation = Reservation::create(
            [
                'name' =>  $request->input('name'),
                'email' => $request->input('email'),
                'tel' => $request->input('tel'),
                'note' => $request->input('note'),
                'stand' => $stand,
                'price_all' => $totalPrice,
                'status' => 1,
                'consent' => (int)$request->input('consent'),
                'date_payment' => null
            ]
        );


        $this->updateSeats($seats, $reservation->id);

        $data = ['reservation' => $reservation, 'seats' => $seats];

        EmailSendingController::sendEmail(EmailContent::Cancel, $data);
        return response()->json($data, 200);
    }

    private function getStandPrice($stand)
    {
        $priceStand = 350;
        return $stand * $priceStand;
    }
    private function getSeatsPrice($seats)
    {

        $priceSit = 500;
        $priceSitRaut = 750;

        $totalPrice = 0;
        foreach ($seats as $seat) {
            if ($seat['typ'] == 'raut') {
                $totalPrice += $priceSitRaut;
            } else {

                $totalPrice += $priceSit;
            }
        }

        return $totalPrice;
    }


    public function cancel(Request $request, $id)
    {
        $seats = Seat::where('rezervace', '=', $id)->get();

        foreach ($seats as $seat) {
            $seat->rezervace = null;
            $seat->save();
        }
        $this->destroy($id);
        return AdministrationController::reservations();
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
