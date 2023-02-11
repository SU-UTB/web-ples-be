<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(schema="Reservation")
 */
class Reservation extends Model
{
    use HasFactory;
    protected $table = 'r2023_rezervace';
    protected $fillable = [
        'name',
        'email',
        'tel',
        'note',
        'stand',
        'price_all',
        'status',
        'date_payment',
        'consent'
    ];


    protected $attributes = [
        'status' => 1
    ];
    /**
     * @OA\Property
     *
     * @var Collection
     */
    public Collection $seats;
}
