<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Zone extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'price_per_hour',
    ];

    public function parking()
    {
        return $this->hasMany(Parking::class);
    }

    // boot
    public static function boot()
    {
        parent::boot();

        static::deleting(function () {
            Cache::forget('zone');
        });

        static::updating(function () {
            Cache::forget('zone');
        });

        static::creating(function () {
            Cache::forget('zone');
        });
    }
}
