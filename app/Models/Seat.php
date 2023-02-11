<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(schema="Seat")
 */
class Seat extends Model
{
    use HasFactory;
    protected $table = 'r2023_seats';
}
