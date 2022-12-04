<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandingPageContent
{

    public Collection $contents;
    public Collection $contacts;
    public LandingPageTicketContent $tickets;

    public function __construct(Collection $contents, Collection $contacts,LandingPageTicketContent $tickets)
    {
        $this->contents = $contents;
        $this->contacts = $contacts;
        $this->tickets = $tickets;
    }
}
