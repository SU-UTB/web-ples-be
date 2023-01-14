<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;

/**
 * @OA\Schema(schema="LandingPageTicketContent")
 */
class LandingPageTicketContent
{
    /**
     * @OA\Property
     *
     * @var string
     */
    public string $reservations_from;
    /**
     * @OA\Property
     *
     * @var Collection
     */
    public Contact $contact;

    public function __construct(string $reservations_from, Contact $contact)
    {
        $this->reservations_from = $reservations_from;
        $this->contact = $contact;
    }
}
