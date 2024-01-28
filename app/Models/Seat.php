<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @OA\Schema(schema="Seat")
 */
class Seat extends Model
{
    use HasFactory;

    protected $table = 'seats';


    public function reservation(): HasOne
    {
        return $this->hasOne(Reservation::class, 'rezervace');
    }
}
