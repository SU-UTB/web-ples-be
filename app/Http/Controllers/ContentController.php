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

    public function index()
    {
        $contents = Content::all();
        $contacts = Contact::all();
        $tickets = TicketContent::find(1);

        $ticketsContact = $contacts->find($tickets->contact_user_id);
        
        $ticketsContent = new LandingPageTicketContent($tickets->reservation_from, $ticketsContact);
        $landingContent =  new LandingPageContent($contents, $contacts->where('role', '!=','tickets'), $ticketsContent);


        return json_encode($landingContent);
    }
}
