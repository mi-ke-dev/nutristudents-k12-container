<?php

declare(strict_types=1);

namespace Bytelaunch\Nutristudents\Models;

use Bytelaunch\Nutristudents\Traits\HasTenantAdmin;
use Bytelaunch\Nutristudents\Traits\Uuid;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Guideline extends Model
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
            
            'weekly_min_usda_componenent_serving_meat',
            'weekly_min_usda_componenent_serving_grain',
            'weekly_min_usda_componenent_serving_fruit',
            'weekly_min_usda_componenent_serving_milk',
            'weekly_min_usda_componenent_serving_veg',
            'weekly_min_usda_componenent_serving_vegleg',
            'weekly_min_usda_componenent_serving_vegred',
            'weekly_min_usda_componenent_serving_veggrn',
            'weekly_min_usda_componenent_serving_vegstar',
            'weekly_min_usda_componenent_serving_vegothr',

            'weekly_max_usda_componenent_serving_meat',
            'weekly_max_usda_componenent_serving_grain',
            'weekly_max_usda_componenent_serving_fruit',
            'weekly_max_usda_componenent_serving_milk',
            'weekly_max_usda_componenent_serving_veg',
            'weekly_max_usda_componenent_serving_vegleg',
            'weekly_max_usda_componenent_serving_vegred',
            'weekly_max_usda_componenent_serving_veggrn',
            'weekly_max_usda_componenent_serving_vegstar',
            'weekly_max_usda_componenent_serving_vegothr',

            'weekly_min_nutrition_facts_calories',
            'weekly_min_nutrition_facts_calfat',
            'weekly_min_nutrition_facts_totalfat',
            'weekly_min_nutrition_facts_satfat',
            'weekly_min_nutrition_facts_transfat',
            'weekly_min_nutrition_facts_polysatfat',
            'weekly_min_nutrition_facts_monosatfat',
            'weekly_min_nutrition_facts_cholesterol',
            'weekly_min_nutrition_facts_sodium',
            'weekly_min_nutrition_facts_potassium',
            'weekly_min_nutrition_facts_carbs',
            'weekly_min_nutrition_facts_fiber',
            'weekly_min_nutrition_facts_sugar',
            'weekly_min_nutrition_facts_protein',
            'weekly_min_nutrition_facts_vitamina',
            'weekly_min_nutrition_facts_vitaminb6',
            'weekly_min_nutrition_facts_vitaminb12',
            'weekly_min_nutrition_facts_vitaminc',
            'weekly_min_nutrition_facts_vitamind',
            'weekly_min_nutrition_facts_vitamine',
            'weekly_min_nutrition_facts_calcium',
            'weekly_min_nutrition_facts_iron',
            'weekly_min_nutrition_facts_magnesium',
            'weekly_min_nutrition_facts_coblamin',
            'weekly_min_nutrition_facts_thiamin',
            'weekly_min_nutrition_facts_riboflavin',
            'weekly_min_nutrition_facts_niacin',
            'weekly_min_nutrition_facts_zinc',
            'weekly_min_nutrition_facts_water',
            'weekly_min_nutrition_facts_ash',

            'weekly_max_nutrition_facts_calories',
            'weekly_max_nutrition_facts_calfat',
            'weekly_max_nutrition_facts_totalfat',
            'weekly_max_nutrition_facts_satfat',
            'weekly_max_nutrition_facts_transfat',
            'weekly_max_nutrition_facts_polysatfat',
            'weekly_max_nutrition_facts_monosatfat',
            'weekly_max_nutrition_facts_cholesterol',
            'weekly_max_nutrition_facts_sodium',
            'weekly_max_nutrition_facts_potassium',
            'weekly_max_nutrition_facts_carbs',
            'weekly_max_nutrition_facts_fiber',
            'weekly_max_nutrition_facts_sugar',
            'weekly_max_nutrition_facts_protein',
            'weekly_max_nutrition_facts_vitamina',
            'weekly_max_nutrition_facts_vitaminb6',
            'weekly_max_nutrition_facts_vitaminb12',
            'weekly_max_nutrition_facts_vitaminc',
            'weekly_max_nutrition_facts_vitamind',
            'weekly_max_nutrition_facts_vitamine',
            'weekly_max_nutrition_facts_calcium',
            'weekly_max_nutrition_facts_iron',
            'weekly_max_nutrition_facts_magnesium',
            'weekly_max_nutrition_facts_coblamin',
            'weekly_max_nutrition_facts_thiamin',
            'weekly_max_nutrition_facts_riboflavin',
            'weekly_max_nutrition_facts_niacin',
            'weekly_max_nutrition_facts_zinc',
            'weekly_max_nutrition_facts_water',
            'weekly_max_nutrition_facts_ash',


            'daily_min_usda_componenent_serving_meat',
            'daily_min_usda_componenent_serving_grain',
            'daily_min_usda_componenent_serving_fruit',
            'daily_min_usda_componenent_serving_milk',
            'daily_min_usda_componenent_serving_veg',
            'daily_min_usda_componenent_serving_vegleg',
            'daily_min_usda_componenent_serving_vegred',
            'daily_min_usda_componenent_serving_veggrn',
            'daily_min_usda_componenent_serving_vegstar',
            'daily_min_usda_componenent_serving_vegothr',

            'daily_max_usda_componenent_serving_meat',
            'daily_max_usda_componenent_serving_grain',
            'daily_max_usda_componenent_serving_fruit',
            'daily_max_usda_componenent_serving_milk',
            'daily_max_usda_componenent_serving_veg',
            'daily_max_usda_componenent_serving_vegleg',
            'daily_max_usda_componenent_serving_vegred',
            'daily_max_usda_componenent_serving_veggrn',
            'daily_max_usda_componenent_serving_vegstar',
            'daily_max_usda_componenent_serving_vegothr',

            'daily_min_nutrition_facts_calories',
            'daily_min_nutrition_facts_calfat',
            'daily_min_nutrition_facts_totalfat',
            'daily_min_nutrition_facts_satfat',
            'daily_min_nutrition_facts_transfat',
            'daily_min_nutrition_facts_polysatfat',
            'daily_min_nutrition_facts_monosatfat',
            'daily_min_nutrition_facts_cholesterol',
            'daily_min_nutrition_facts_sodium',
            'daily_min_nutrition_facts_potassium',
            'daily_min_nutrition_facts_carbs',
            'daily_min_nutrition_facts_fiber',
            'daily_min_nutrition_facts_sugar',
            'daily_min_nutrition_facts_protein',
            'daily_min_nutrition_facts_vitamina',
            'daily_min_nutrition_facts_vitaminb6',
            'daily_min_nutrition_facts_vitaminb12',
            'daily_min_nutrition_facts_vitaminc',
            'daily_min_nutrition_facts_vitamind',
            'daily_min_nutrition_facts_vitamine',
            'daily_min_nutrition_facts_calcium',
            'daily_min_nutrition_facts_iron',
            'daily_min_nutrition_facts_magnesium',
            'daily_min_nutrition_facts_coblamin',
            'daily_min_nutrition_facts_thiamin',
            'daily_min_nutrition_facts_riboflavin',
            'daily_min_nutrition_facts_niacin',
            'daily_min_nutrition_facts_zinc',
            'daily_min_nutrition_facts_water',
            'daily_min_nutrition_facts_ash',

            'daily_max_nutrition_facts_calories',
            'daily_max_nutrition_facts_calfat',
            'daily_max_nutrition_facts_totalfat',
            'daily_max_nutrition_facts_satfat',
            'daily_max_nutrition_facts_transfat',
            'daily_max_nutrition_facts_polysatfat',
            'daily_max_nutrition_facts_monosatfat',
            'daily_max_nutrition_facts_cholesterol',
            'daily_max_nutrition_facts_sodium',
            'daily_max_nutrition_facts_potassium',
            'daily_max_nutrition_facts_carbs',
            'daily_max_nutrition_facts_fiber',
            'daily_max_nutrition_facts_sugar',
            'daily_max_nutrition_facts_protein',
            'daily_max_nutrition_facts_vitamina',
            'daily_max_nutrition_facts_vitaminb6',
            'daily_max_nutrition_facts_vitaminb12',
            'daily_max_nutrition_facts_vitaminc',
            'daily_max_nutrition_facts_vitamind',
            'daily_max_nutrition_facts_vitamine',
            'daily_max_nutrition_facts_calcium',
            'daily_max_nutrition_facts_iron',
            'daily_max_nutrition_facts_magnesium',
            'daily_max_nutrition_facts_coblamin',
            'daily_max_nutrition_facts_thiamin',
            'daily_max_nutrition_facts_riboflavin',
            'daily_max_nutrition_facts_niacin',
            'daily_max_nutrition_facts_zinc',
            'daily_max_nutrition_facts_water',
            'daily_max_nutrition_facts_ash',
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
}
