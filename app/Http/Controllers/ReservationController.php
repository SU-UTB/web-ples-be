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
                'consent' => (int)$request->input('consent'),
                'date_payment' => Carbon::now()
            ]
        );
        $seats = Seat::findMany($request->input('seats'))->toArray();
        $this->updateSeats($seats, $reservation->id);

        $data = ['reservation' => $reservation, 'seats' => $seats];

        // $this->sendEmail();

        return view("reserved", $data);
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

    public function sendEmail()
    {
        $data = array('name' => "Virat Gandhi");
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
