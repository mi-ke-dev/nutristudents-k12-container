<?php

declare(strict_types=1);

namespace Bytelaunch\Nutristudents\Models;

use App\Models\Booking;
use App\Models\Buyer;
use App\Models\BuyersAgent;
use App\Scopes\OfferScope;
use Bytelaunch\Nutristudents\Enum\CategoryEnum;
use Bytelaunch\Nutristudents\Traits\Uuid;
use HarcourtsAuctions\PropertyPortal\Database\Factories\OfferFactory;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MenuCreationGroup extends Model
{
    //use HasUuid;
    use HasFactory;
    use Uuid;

    protected $casts = [
        //
    ];

    protected $fillable = [
        'name',
        'day_id',
        'meal_type_id',        
        'age_grade_offering_id',
        'guideline_id'
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
    

    public function meal_type(): BelongsTo
    {
        return $this->belongsTo(MealType::class, 'meal_type_id');
    }

    public function days(): BelongsTo
    {
        return $this->belongsTo(Days::class, 'day_id');
    }

    public function age_grade(): BelongsTo
    {
        return $this->belongsTo(AgeGradeOffering::class,'age_grade_offering_id');
    }

    //=============================================================================
    // Local Scopes
    // learn more @ https://laravel.com/docs/8.x/eloquent#local-scopes
    //=============================================================================

    public function guideline(): BelongsTo
    {
        return $this->belongsTo(Guideline::class);
    }

    public function ingredients(): BelongsToMany
    {
        return $this->belongsToMany(Ingredient::class);
    }

    public function offerings(): BelongsToMany
    {
        return $this->belongsToMany(Offering::class,'menu_creation_group_offerings');
    }

    public function scopeSearchByAll($query, $search){
        $query->where(function($q) use($search){
            $q->whereRaw("LOWER(name) LIKE '%".strtolower($search)."%'");
            //$q->orWhereRaw("LOWER(id::text) LIKE '%".strtolower($search)."%'");
        });
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

    public function menu_planings(){
        return $this->hasMany(UserPermission::class, 'group_id')->where('type', 'menu_planings');
    }

    public function food_preparation(){
        return $this->hasMany(UserPermission::class, 'group_id')->where('type', 'food_preparation');
    }
}
