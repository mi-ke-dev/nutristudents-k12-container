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

class Allergen extends Model
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
    protected static function scopeCorn(Builder $query): Model
    {
        return $query->where('name', 'Corn')->firstOrFail();
    }
    protected static function scopeEgg(Builder $query): Model
    {
        return $query->where('name', 'Egg')->firstOrFail();
    }
    protected static function scopeFish(Builder $query): Model
    {
        return $query->where('name', 'Fish')->firstOrFail();
    }
    protected static function scopeMeat(Builder $query): Model
    {
        return $query->where('name', 'Meat')->firstOrFail();
    }
    protected static function scopeMilk(Builder $query): Model
    {
        return $query->where('name', 'Milk')->firstOrFail();
    }
    protected static function scopePeanut(Builder $query): Model
    {
        return $query->where('name', 'Peanut')->firstOrFail();
    }
    protected static function scopeShellfish(Builder $query): Model
    {
        return $query->where('name', 'Shellfish')->firstOrFail();
    }
    protected static function scopeSoy(Builder $query): Model
    {
        return $query->where('name', 'Soy')->firstOrFail();
    }
    protected static function scopeTreenut(Builder $query): Model
    {
        return $query->where('name', 'Treenut')->firstOrFail();
    }
    protected static function scopeWheat(Builder $query): Model
    {
        return $query->where('name', 'Wheat')->firstOrFail();
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
