<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicles extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id', 'plate_number', 'brand', 'model',
    ];

    // create a boot method
    protected static function boot()
    {
        parent::boot();

        //   check if we have a creating event
        static::creating(function (self $vehicle) {
            if (auth()->check()) {
                $vehicle->user_id = auth()->id();
            }
        });

        // Global Scope for auth user
        static::addGlobalScope('user', function (EloquentBuilder $builder) {
            $builder->where('user_id', auth()->id());
        });
    }

    // protected $hidden = [
    //     'deleted_at',
    // ];

    public function parking(): HasMany
    {
        return $this->hasMany(Parking::class);
    }
}
