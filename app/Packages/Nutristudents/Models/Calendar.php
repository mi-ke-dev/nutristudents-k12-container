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

class Calendar extends Model
{
    use HasFactory;
    use Uuid;

    protected $casts = [
        //
    ];

    protected $fillable = [
        'age_grade_offering_id', 
        'meal_type_id', 
        'month_year', 
        'day_id',
        'site_id',
        'guide_line_id',
        'site_type',
        'offering_id',
        'group_id'
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
    // public function site(): BelongsTo
    // {
    //     return $this->belongsTo(Site::class);
    // }
    // public function meal_type(): BelongsTo
    // {
    //     return $this->belongsTo(MealType::class, 'meal_id');
    // }
    // public function grade_range(): BelongsTo
    // {
    //     return $this->belongsTo(GradeRange::class);
    // }

    public function calendar_days(): HasMany
    {
        return $this->hasMany(CalendarDay::class, 'calendar_id')->orderBy('week_number');
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
