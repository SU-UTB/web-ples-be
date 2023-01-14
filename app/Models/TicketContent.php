<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(schema="TicketContent")
 */
class TicketContent extends Model
{
    use HasFactory;
    protected $table = 'tickets';
}
