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

class MenuCycleDay extends Model
{
    //use HasUuid;
    use HasFactory;
    use Uuid;

    protected $casts = [
        //
    ];

    protected $appends = ['day_of_week_number'];

    protected $fillable = [
        'day_of_week'
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
    public function menuCycle(): BelongsTo
    {
        return $this->belongsTo(MenuCycle::class);
    }

    // public function menuCycleDayOption(): HasOne
    // {
    //     return $this->hasOne(MenuCycleDayOption::class);
    // }

    public function menuCycleDayOptions(): HasMany
    {
        return $this->hasMany(MenuCycleDayOption::class)->orderBy('sort_order', 'asc');
    }


    // public static function boot() {
    //     parent::boot();
    //     self::deleting(function($menuCycleDay) {
    //         $menuCycleDay->menuCycleDayOptions()->each(function($menuCycleDayOption) {
    //             $menuCycleDayOption->delete();
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
    public function getDayOfWeekNumberAttribute($value)
    {
        $weeks = ['MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT', 'SUN'];
      return array_search($this->day_of_week, $weeks);
    }

    public function getIsAssemblyInstructionsAttribute()
    {
        $options = $this->menuCycleDayOptions->whereNotNull('assembly_instructions')->where('assembly_instructions', '!=', '');
        if($options->count() > 0){
            return true;
        }
      return false;
    }
}
