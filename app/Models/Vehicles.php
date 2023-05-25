<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicles extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id', 'plate_number', 'brand', 'model'
    ];
}
