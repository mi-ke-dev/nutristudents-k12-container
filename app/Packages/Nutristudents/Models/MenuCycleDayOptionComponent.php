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

class MenuCycleDayOptionComponent extends Model
{
    //use HasUuid;
    use HasFactory;
    use Uuid;

    protected $casts = [
        //
        // 'total_val_override' => 'array'
        'is_exclude_from_printable_calendar' => 'boolean',
        'is_exclude_export' => 'boolean'
    ];

    protected $fillable = [
        'cooking_instructions',
        'sort_order',
        'recipe_id',
        'exclude_from',
        'smart_snack',
        'is_override',
        'total_val_override',
        'source_id',
        'is_exclude_export',
        'is_exclude_from_printable_calendar'
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
    // protected static function newFactory(): Factory
    // {
    //     //return ModelFactory::new();
    // }

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
    public function menuCycleDayOption(): BelongsTo
    {
        return $this->BelongsTo(MenuCycleDayOption::class);
    }

    public function recipe(): BelongsTo
    {
        return $this->belongsTo(Recipe::class);
    }

    public function foodOrderStudentCount(): HasOne
    {
        return $this->hasOne(FoodOrderStudentCount::class,'option_id','source_id');
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
    public function getTotalValOverrideAttribute($value)
    {
        // echo json_decode($value);
        if($value){
            // dd($value);
            // var_dump($value);
            // var_dump(json_decode($value));
            // die;
            return json_decode($value);
        } else {
            $x = new \stdClass();
            $x->MMA = null;
            $x->WGR = null;
            $x->FRU = null;
            $x->MLK = null;
            $x->VEG = null;
            $x->DG = null;
            $x->RO = null;
            $x->LEG = null;
            $x->STAR = null;
            $x->OTH = null;
            $x->CALS = null;
            $x->SOD = null;
            $x->FAT = null;
            $x->PROT = null;
            $x->CARB = null;
            // var_dump(json_decode(json_encode($x)));
            // die;
            return json_decode(json_encode($x));
        }
    }
}
