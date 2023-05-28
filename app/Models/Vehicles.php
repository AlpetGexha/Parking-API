<?php

namespace App\Models;

use App\Models\Scopes\AuthUserScope;
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
    protected static function booted()
    {
        static::addGlobalScope(new AuthUserScope);
    }

    public function parking(): HasMany
    {
        return $this->hasMany(Parking::class);
    }
}
