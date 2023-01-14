<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(schema="LandingPageContent")
 */
class LandingPageContent extends JsonResource
{
  /**
     * @OA\Property
     *
     * @var Collection
     */
    public Collection $contents;
      /**
     * @OA\Property
     *
     * @var Collection
     */
    public Collection $contacts;
          /**
     * @OA\Property
     *
     * @var LandingPageTicketContent
     */
    public LandingPageTicketContent $tickets;

    public function __construct(Collection $contents, Collection $contacts,LandingPageTicketContent $tickets)
    {
        $this->contents = $contents;
        $this->contacts = $contacts;
        $this->tickets = $tickets;
    }
}
