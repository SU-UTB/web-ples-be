<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Content;
use App\Models\LandingPageContent;
use App\Models\LandingPageTicketContent;
use App\Models\TicketContent;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ContentLandingEditController extends Controller
{
    /**
     * @OA\Get(
     *    path="/admin/content/landing",
     *    tags={"Admin"},
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
    public function indexLanding()
    {

        $landingContent = ContentLandingController::getLandingContent();

        return view('administration/content/landing', ['data' => $landingContent]);
    }
    /**
     * @OA\Get(
     *    path="/admin/content/landing/contacts",
     *    tags={"Admin"},
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
    public function indexContacts()
    {

        $landingContent = ContentLandingController::getLandingContent();

        return view('administration/content/landingContacts', ['data' => $landingContent->contacts]);
    }

        /**
     * @OA\Get(
     *    path="/admin/content/landing/tickets",
     *    tags={"Admin"},
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
    public function indexTickets()
    {

        $landingContent = ContentLandingController::getLandingContent();

        return view('administration/content/landingTickets', ['data' => $landingContent->tickets]);
    }


    ///UPDATES


    public function updateContent(Request $request, $id)
    {
        $content = Content::find($id);
        $content->update(['content' => $request->input('content')]);

        return $this->indexLanding();
    }
    public function updateContact(Request $request, $id)
    {
        $contact = Contact::find($id);
        $contact->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone')
        ]);

        return $this->indexContacts();
    }
    public function updateTicketsDate(Request $request)
    {

        $tickets = TicketContent::find(1);
        $tickets->reservation_from = $request->input('reservations_from');
        $tickets->save();


        return $this->indexTickets();
    }
}
