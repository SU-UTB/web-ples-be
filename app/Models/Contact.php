<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @OA\Schema(schema="Contact")
 */
class Contact extends Model
{
    use HasFactory;
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['created_at','updated_at'];

    protected $fillable = [
        'name',
        'email',
        'phone'
    ];
}
