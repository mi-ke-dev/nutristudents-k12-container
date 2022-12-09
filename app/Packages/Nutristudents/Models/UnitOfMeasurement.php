<?php

declare(strict_types=1);

namespace Bytelaunch\Nutristudents\Models;

use App\Models\Booking;
use App\Models\Buyer;
use App\Models\BuyersAgent;
use App\Scopes\OfferScope;
use Bytelaunch\Nutristudents\Enum\UnitOfMeasurementEnum;
use Bytelaunch\Nutristudents\Traits\Uuid;
use HarcourtsAuctions\PropertyPortal\Database\Factories\OfferFactory;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Collection;

class UnitOfMeasurement extends Model
{
    //use HasUuid;
    use HasFactory;
    use Uuid;

    public $appneds = ['sort_name'];

    protected $casts = [
        //
    ];

    protected $fillable = [
        'name',
        'type',
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
    protected static function scopePound(Builder $query): UnitOfMeasurement
    {
        return $query->where('name', 'Pound')->firstOrFail();
    }
    protected static function scopeLb(Builder $query): UnitOfMeasurement
    {
        return $query->where('name', 'LB')->firstOrFail();
    }

    protected static function scopeOunce(Builder $query): UnitOfMeasurement
    {
        return $query->where('name', 'Ounce')->firstOrFail();
    }

    protected static function scopeGallon(Builder $query): UnitOfMeasurement
    {
        return $query->where('name', 'Gallon')->firstOrFail();
    }

    protected static function scopeQuart(Builder $query): UnitOfMeasurement
    {
        return $query->where('name', 'Quart')->firstOrFail();
    }

    protected static function scopePint(Builder $query): UnitOfMeasurement
    {
        return $query->where('name', 'Pint')->firstOrFail();
    }

    protected static function scopeCup(Builder $query): UnitOfMeasurement
    {
        return $query->where('name', 'Cup')->firstOrFail();
    }

    protected static function scopeFluidOunce(Builder $query): UnitOfMeasurement
    {
        return $query->where('name', 'Fluid Ounce')->firstOrFail();
    }

    protected static function scopeTablespoon(Builder $query): UnitOfMeasurement
    {
        return $query->where('name', 'Tablespoon')->firstOrFail();
    }

    protected static function scopeTeaspoon(Builder $query): UnitOfMeasurement
    {
        return $query->where('name', 'Teaspoon')->firstOrFail();
    }

    protected static function scopeGram(Builder $query): UnitOfMeasurement
    {
        return $query->where('name', 'Gram')->firstOrFail();
    }

    protected static function scopePiece(Builder $query): UnitOfMeasurement
    {
        return $query->where('name', 'Piece')->firstOrFail();
    }
    protected static function scopeQty(Builder $query): UnitOfMeasurement
    {
        return $query->where('name', 'Qty')->firstOrFail();
    }

    protected static function scopeEa(Builder $query): UnitOfMeasurement
    {
        return $query->where('name', 'Each')->firstOrFail();
    }

    protected static function scopeNa(Builder $query): UnitOfMeasurement
    {
        return $query->where('name', 'N/A')->firstOrFail();
    }


    protected static function scopeMassMeasurements(Builder $query): Collection
    {
        return $query->where('type', 'MASS')->get();
    }

    protected static function scopeUnitMeasurements(Builder $query): Collection
    {
        return $query->where('type', 'UNIT')->get();
    }

    protected static function scopeVolumeMeasurements(Builder $query): Collection
    {
        return $query->where('type', 'VOLUME')->get();
    }


    //=============================================================================
    // Relationships
    // - https://laravel.com/docs/8.x/eloquent-relationships
    // - https://hackernoon.com/eloquent-relationships-cheat-sheet-5155498c209
    //=============================================================================
    /*
    // example relationship
    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }
    */

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

    public function getSortNameAttribute(){
        return UnitOfMeasurementEnum::getSortName($this->name);
    }
}
