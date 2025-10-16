<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    protected $fillable = [
        'sender_id',
        'receiver_url',
        'amount',
        'status',
    ];
}
