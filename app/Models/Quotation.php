<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    protected $fillable = [
        'client_name',
        'product',
        'amount',
        'valid_till',
        'notes'
    ];
}
