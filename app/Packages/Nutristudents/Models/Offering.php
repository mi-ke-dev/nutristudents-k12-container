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
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Offering extends Model
{
    //use HasUuid;
    use HasFactory;
    use Uuid;

    protected $casts = [
        //
    ];

    protected $fillable = [
        'name',
        'prep_site_id',
        'cook_site_id',
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

//    //=============================================================================
//    // Setup and Configuration
//    //=============================================================================
//    public static function boot()
//    {
//        parent::boot();
//
//        //
//    }

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
    public function site(): BelongsTo
    {
        return $this->belongsTo(Site::class);
    }

    public function mealPreparationGroups(): BelongsToMany
    {
        return $this->belongsToMany(MealPreparationGroup::class,'meal_preparation_group_offerings');
    }

    public function guideline(): BelongsTo
    {
        return $this->belongsTo(Guideline::class);
    }

    // public function menu_adminable(): MorphTo
    // {
    //     return $this->morphTo();
    // }

    // public function order_adminable(): MorphTo
    // {
    //     return $this->morphTo();
    // }

    // public function prep_site(): BelongsTo
    // {
    //     return $this->belongsTo(Site::class, 'id', 'prep_site_id');
    // }

    // public function cook_site(): BelongsTo
    // {
    //     return $this->belongsTo(Site::class, 'id', 'cook_site_id');
    // }


    public function headcounts(){
        return $this->hasMany(UserPermission::class)->where('type', 'headcounts');
    }

    public function menu_planings(){
        return $this->hasMany(UserPermission::class)->where('type', 'menu_planings');
    }

    public function food_preparation(){
        return $this->hasMany(UserPermission::class)->where('type', 'food_preparation');
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
