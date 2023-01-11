<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(type="object")
 */
class LandingPageContent extends JsonResource
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
