<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livedata extends Model
{
    /** @use HasFactory<\Database\Factories\LivedataFactory> */
    use HasFactory;

    protected $fillable = [
        'UrGHouse' => '0',
        'tempGhouse' => '0',
        'lum' => '0',
        'sen1' => '0',
         'sen2' => '0',
         'sen3' => '0',
         'tempExternal' => '0',
         'UrExternal' => '0',
     'maxTemp' => '0',
     'minTemp' => '0',
     'queue' => '0',
     'lastCycleEpoch' => '0',
     'lastIr1Epoch' => '0',
     'lastIr2Epoch' => '0',
     'lastIr3Epoch' => '0',
     'lastIr4Epoch' => '0',
     'lastIr5Epoch' => '0',
     'lastCycleStart' => '0',
    ];


}
