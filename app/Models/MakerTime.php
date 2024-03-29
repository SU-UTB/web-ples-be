<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MakerTime extends Model
{
    use HasFactory;

    protected $fillable = [
        'maker_id',
        'time'
    ];

}
