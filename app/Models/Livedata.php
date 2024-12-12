<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livedata extends Model
{
    /** @use HasFactory<\Database\Factories\LivedataFactory> */
    use HasFactory;

    protected $fillable = [
        'UrGHouse',
        'tempGHouse',
        'lum',
    ];


}
