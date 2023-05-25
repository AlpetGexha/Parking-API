<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkingEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'parking_id', 'event_type', 'event_time',
    ];
}
