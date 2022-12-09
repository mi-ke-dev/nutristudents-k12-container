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

use App\Models\User;
use Bytelaunch\Nutristudents\Traits\HasTenantAdmin;

class MenuCycle extends Model
{
    //use HasUuid;
    use HasFactory;
    use Uuid;
    use HasTenantAdmin;

    protected $casts = [
        //
    ];

    protected $fillable = [
        'tenant_id',
        'name',
        'meal_type_id',
        'age_grade_id',
        'days_id',
        'user_id',
        'guideline_id',
        'week_number',
        'is_template',
        'source_id'
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

    public function scopeIsTemplate(Builder $query){
        return $query->where('is_template', true);
    }

    

    //=============================================================================
    // Relationships
    // - https://laravel.com/docs/8.x/eloquent-relationships
    // - https://hackernoon.com/eloquent-relationships-cheat-sheet-5155498c209
    //=============================================================================
    public function gradeRange(): BelongsTo
    {
        return $this->belongsTo(GradeRange::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function menuCycleDays(): HasMany
    {
        return $this->HasMany(MenuCycleDay::class);
    }

    public function guideline(): BelongsTo
    {
        return $this->belongsTo( Guideline::class, 'guideline_id');
    }

    public function day(): BelongsTo
    {
        return $this->belongsTo(Days::class, 'days_id');
    }

    public function source(): BelongsTo
    {
        return $this->belongsTo(MenuCycle::class, 'source_id');
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

    public function getOptionNameAttribute()
    {
        $menuCycleDays = $this->menuCycleDays()->get();
        $day = [];
        foreach($menuCycleDays as $menuCycleDay){
            // $day[$menuCycleDay->day_of_week] = "";
            if($menuCycleDay->menuCycleDayOptions->count() > 0){
                $day[] = $menuCycleDay->day_of_week .":". $menuCycleDay->menuCycleDayOptions[0]->name;
            }
        }
        return implode(', ', $day);
    }


    // public static function boot() {
    //     parent::boot();
    //     self::deleting(function($menuCycle) {
    //         $menuCycle->menuCycleDays()->each(function($menuCycleDay) {
    //             $menuCycleDay->delete();
    //         });
    //     });
    // }
    
}
