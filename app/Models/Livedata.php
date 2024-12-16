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
        'tempGhouse',
        'lum',
        'sen1',
         'sen2',
         'sen3',
         'tempExternal',
         'UrExternal',
     'maxTemp',
     'minTemp',
     'queue',
     'lastCycleEpoch',
     'lastIr1Epoch',
     'lastIr2Epoch',
     'lastIr3Epoch',
     'lastIr4Epoch',
     'lastIr5Epoch',
     'lastCycleStart',
    ];


}
