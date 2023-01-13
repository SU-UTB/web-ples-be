<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Content;
use App\Models\LandingPageContent;
use App\Models\LandingPageTicketContent;
use App\Models\TicketContent;
use Illuminate\Http\Request;
use Tmp;

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
