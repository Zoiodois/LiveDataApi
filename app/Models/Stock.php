<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stock extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'batchId',
        'matrixId',
        'seedBankId',
        'idColor',
        'quantity',
        'plantDate',
        'endPrevision',
        'status',
        'quantitySold',
        'quantityDead',
        'observation',
        'displayName',

    ];

    protected $guarded =[];
}


