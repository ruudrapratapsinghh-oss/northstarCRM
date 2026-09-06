<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'company',
        'status',
        'user_id',
        'follow_up_date',
        'notes'

    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
