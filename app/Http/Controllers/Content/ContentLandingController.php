<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Models\AvailableStands;
use App\Models\Contact;
use App\Models\Content;
use App\Models\LandingPageContent;
use App\Models\LandingPageTicketContent;
use App\Models\Seat;
use App\Models\TicketContent;
use Illuminate\Http\Request;

class ContentLandingController extends Controller
{
    /**
     * @OA\Get(
     *    path="/api/pages/landing",
     *    tags={"Pages"},
     *    summary="Get content of landing page",
     *    description="Get content of landing page",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *      @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(ref="#/components/schemas/LandingPageContent")
     *          )
     *       ),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   @OA\Response(response=404, description="Not Found")
     *  )
     */
    public function index()
    {
        $landingContent = $this->getLandingContent();
        return json_encode($landingContent, JSON_UNESCAPED_UNICODE);
    }

    /**
     * @OA\Get(
     *    path="/api/pages/reservations",
     *    tags={"Pages"},
     *    summary="Get content of reservations page",
     *    description="Get content of reservations page",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *      @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *            
     *                            @OA\Property(
     *                     property="takenSeats",
     *                     type="integer"
     *                 ),     
     *                @OA\Property(
     *                     property="freeSeats",
     *                     type="integer"
     *                 ),
     *                       @OA\Property(
     *      type="array",
     *      @OA\Items(
     *          type="array",
     *          @OA\Items()
     *      ),
     *      description="List of Seat ids"
     * ),

     *                 example={ "takenSeats": 3, "freeSeats": 7, "seats" = {3,54,645,}}
     *            
     *          )
     *          )
     *       ),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   @OA\Response(response=404, description="Not Found")
     *  )
     */
    public function indexReservations()
    {
        $takenSeats = count(Seat::where('rezervace', '!=', null)->get());
        $freeSeats = count(Seat::where('rezervace', '=', null)->get());
        $seats = Seat::all();
        $availableStands = AvailableStands::find(1);
        $response = [
            "freeSeats" => $freeSeats,
            "takenSeats" => $takenSeats,
            "seats" => $seats,
            "availableStands" =>$availableStands->count
        ];
        return response($response, 200);
    }
    public static function getLandingContent()
    {
        $contents = Content::all();
        $contacts = Contact::all();
        $tickets = TicketContent::find(1);

        $ticketsContact = $contacts->find($tickets->contact_user_id);

        $ticketsContent = new LandingPageTicketContent($tickets->reservation_from, $ticketsContact);
        $landingContent =  new LandingPageContent($contents, $contacts->where('role', '!=', 'tickets'), $ticketsContent);

        return $landingContent;
    }
}
