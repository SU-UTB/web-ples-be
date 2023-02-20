<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MakerReservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'maker',
        'time',
        'service',
        'name',
        'phone',
        'email',
        'consent'
    ];

}
