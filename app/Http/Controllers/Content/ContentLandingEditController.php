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
    public function indexLanding()
    {

        $landingContent = ContentLandingController::getLandingContent();

        return view('administration/content/landing', ['data' => $landingContent]);
    }
    public function indexContacts()
    {

        $landingContent = ContentLandingController::getLandingContent();

        return view('administration/content/landingContacts', ['data' => $landingContent->contacts]);
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
}
