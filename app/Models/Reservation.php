<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'zone_id', 'spot_numer', 'start_time', 'end_time', 'status',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'stop_time' => 'datetime',
    ];
}
