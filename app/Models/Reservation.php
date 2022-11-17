<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    //protected $table = '';
    protected $fillable = [
        'name',
        'email',
        'tel',
        'note',
        'stand',
        'price_all',
        'status',
        'date_reservation',
        'date_payment'
    ];


    protected $attributes = [
        'status' => 1
    ];
}
