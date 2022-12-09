<?php

declare(strict_types=1);

namespace Bytelaunch\Nutristudents\Models;

use App\Models\Booking;
use App\Models\Buyer;
use App\Models\BuyersAgent;
use App\Scopes\OfferScope;
use Bytelaunch\Nutristudents\Traits\Uuid;
use HarcourtsAuctions\PropertyPortal\Database\Factories\OfferFactory;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Component extends Model
{
    //use HasUuid;
    use HasFactory;
    use Uuid;

    protected $casts = [
        //
    ];

    protected $fillable = [
        'name'
    ];

    /**
     * @var string[][]
     */
    public static $createRules = [
        // 'example_field' => ['required', 'string', 'max:255'],
    ];

    /**
     * @var string[][]
     */
    public static $updateRules = [
        // 'example_field' => ['required', 'string', 'max:255'],
    ];



    //=============================================================================
    // Setup and Configuration
    //=============================================================================
    protected static function newFactory(): Factory
    {
        //return ModelFactory::new();
    }

    //=============================================================================
    // Local Scopes
    // learn more @ https://laravel.com/docs/8.x/eloquent#local-scopes
    //=============================================================================
    protected static function scopeMeat(Builder $query): Model
    {
        return $query->where('name', 'Meat')->firstOrFail();
    }
    protected static function scopeGrain(Builder $query): Model
    {
        return $query->where('name', 'Grain')->firstOrFail();
    }
    protected static function scopeFruit(Builder $query): Model
    {
        return $query->where('name', 'Fruit')->firstOrFail();
    }
    protected static function scopeVeg(Builder $query): Model
    {
        return $query->where('name', 'Veg')->firstOrFail();
    }
    protected static function scopeVegLeg(Builder $query): Model
    {
        return $query->where('name', 'Veg/Leg')->firstOrFail();
    }
    protected static function scopeVegRed(Builder $query): Model
    {
        return $query->where('name', 'Veg/Red')->firstOrFail();
    }
    protected static function scopeVegGrn(Builder $query): Model
    {
        return $query->where('name', 'Veg/Grn')->firstOrFail();
    }
    protected static function scopeVegStar(Builder $query): Model
    {
        return $query->where('name', 'Veg/Star')->firstOrFail();
    }
    protected static function scopeVegOther(Builder $query): Model
    {
        return $query->where('name', 'Veg/Other')->firstOrFail();
    }
    protected static function scopeDairy(Builder $query): Model
    {
        return $query->where('name', 'Veg/Other')->firstOrFail();
    }
    protected static function scopeNa(Builder $query): Model
    {
        return $query->where('name', 'N/A')->firstOrFail();
    }

    //=============================================================================
    // Relationships
    // - https://laravel.com/docs/8.x/eloquent-relationships
    // - https://hackernoon.com/eloquent-relationships-cheat-sheet-5155498c209
    //=============================================================================
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    public function ingredients(): HasMany
    {
        return $this->hasMany(Ingredient::class);
    }

    //=============================================================================
    // Mutators
    //  - https://laravel.com/docs/8.x/eloquent-mutators#defining-a-mutator
    //=============================================================================
    /*
    // example mutator
    public function setFirstNameAttribute($value)
    {
      $this->attributes['first_name'] = strtolower($value);
    }
    */

    //=============================================================================
    // Accessors
    //  - https://laravel.com/docs/8.x/eloquent-mutators#defining-an-accessor
    //=============================================================================
    /*
    // example accessor
    public function getFirstNameAttribute($value)
    {
      return ucfirst($value);
    }
    */
}
