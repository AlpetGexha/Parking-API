<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Parking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'vehicle_id', 'zone_id', 'start_time', 'end_time', 'total_price', 'is_active',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'stop_time' => 'datetime',
    ];

    // create boot method
    protected static function boot()
    {
        parent::boot();

        // check if we have a creating event
        static::creating(function (self $parking) {
            if (auth()->check()) {
                $parking->user_id = auth()->id();
            }

            $parking->start_time = now();

        });

        // Global Scope for auth user
        static::addGlobalScope('user', function (Builder $builder) {
            $builder->where('user_id', auth()->id());
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicles::class);
    }

    public function zone(): BelongsTo
    {
        return $this->belongsTo(Zone::class);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->whereNull('end_time');
    }

    public function scopeStopped(Builder $query): Builder
    {
        return $query->whereNotNull('end_time');
    }

    public function scopeIsActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }
}
