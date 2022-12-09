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
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MenuCycleDayOption extends Model
{
    //use HasUuid;
    use HasFactory;
    use Uuid;

    protected $casts = [
        'a_la_carte' => 'boolean',
        'is_exclude_from_export' => 'boolean',
        'is_favorite' => 'boolean'
    ];

    protected $fillable = [
        'photo_store_path',
        'sort_order',
        'name',
        'is_favorite',
        'assembly_serving', 
        'assembly_serving_unit', 
        'assembly_instructions', 
        'is_exclude_from_export',
        'a_la_carte',
        'assembly_serving_free_text'
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
    /*
    // example local scope
    protected static function scopeWithInternalNotes(Builder $query): Builder
    {
        return $query->with('offerNotes:id,offer_id,notes');
    }
    */

    //=============================================================================
    // Relationships
    // - https://laravel.com/docs/8.x/eloquent-relationships
    // - https://hackernoon.com/eloquent-relationships-cheat-sheet-5155498c209
    //=============================================================================
    public function menuCycleDay(): BelongsTo
    {
        return $this->belongsTo(MenuCycleDay::class);
    }

    public function menuCycleDayOptionComponents(): HasMany
    {
        return $this->hasMany(MenuCycleDayOptionComponent::class)->orderBy('sort_order', 'asc');
    }

    public function assembly_serving_units(): BelongsTo
    {
        return $this->belongsTo(UnitOfMeasurement::class, 'assembly_serving_unit');
    }


    // public static function boot() {
    //     parent::boot();
    //     self::deleting(function($menuCycleDayOption) {
    //         $menuCycleDayOption->menuCycleDayOptionComponents()->each(function($menuCycleDayOptionComponent) {
    //             $menuCycleDayOptionComponent->delete();
    //         });
    //     });
    // }



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
