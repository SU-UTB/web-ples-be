<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Content;
use App\Models\LandingPageContent;
use App\Models\TicketContent;
use App\Models\LandingPageTicketContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Log;

class ContentController extends Controller
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
        $contents = Content::all();
        $contacts = Contact::all();
        $tickets = TicketContent::find(1);

        $ticketsContact = $contacts->find($tickets->contact_user_id);

        $ticketsContent = new LandingPageTicketContent($tickets->reservation_from, $ticketsContact);
        $landingContent =  new LandingPageContent($contents, $contacts->where('role', '!=', 'tickets'), $ticketsContent);


        return json_encode($landingContent, JSON_UNESCAPED_UNICODE);
    }
}
