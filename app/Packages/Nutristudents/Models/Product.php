<?php

declare(strict_types=1);

namespace Bytelaunch\Nutristudents\Models;

use App\Models\Booking;
use App\Models\Buyer;
use App\Models\BuyersAgent;
use App\Models\Tenant;
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
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use App\Models\User;
use Bytelaunch\Nutristudents\Traits\HasTenantAdmin;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    //use HasUuid;
    use HasFactory;
    use Uuid;
    use HasTenantAdmin;
    use SoftDeletes;

    protected $appends = ['allergens_name', 'is_usda'];

    protected $fillable = [
        'tenant_id',
        'sub_case_volume',
        'case_volume',
        'case_weight_uom_id',
        'sub_case_weight_uom_id',
        'case_volume_uom_id',
        'sub_case_volume_uom_id',
        'serving_measurement_weight_uom_id',
        'serving_measurement_volume_uom_id',
        'serving_measurement_unit_uom_id',
        'nutrition_facts_weight_uom_id',
        'nutrition_facts_volume_uom_id',
        'nutrition_facts_unit_uom_id',
        'case_weight',
        'nutrition_facts_thiamin',
        'nutrition_facts_ash',
        'nutrition_facts_calcium',
        'nutrition_facts_calfat',
        'nutrition_facts_calories',
        'nutrition_facts_carbs',
        'nutrition_facts_cholesterol',
        'nutrition_facts_coblamin',
        'nutrition_facts_fiber',
        'nutrition_facts_iron',
        'nutrition_facts_magnesium',
        'nutrition_facts_monosatfat',
        'nutrition_facts_niacin',
        'nutrition_facts_polysatfat',
        'nutrition_facts_potassium',
        'nutrition_facts_protein',
        'nutrition_facts_riboflavin',
        'nutrition_facts_satfat',
        'nutrition_facts_sodium',
        'nutrition_facts_sugar',
        'nutrition_facts_thamin',
        'nutrition_facts_totalfat',
        'nutrition_facts_transfat',
        'nutrition_facts_unit',
        'nutrition_facts_vitamina',
        'nutrition_facts_vitaminb12',
        'nutrition_facts_vitaminb6',
        'nutrition_facts_vitaminc',
        'nutrition_facts_vitamind',
        'nutrition_facts_vitamine',
        'nutrition_facts_volume',
        'nutrition_facts_water',
        'nutrition_facts_weight',
        'nutrition_facts_zinc',
        'serving_measurement_unit',
        'serving_measurement_volume',
        'serving_measurement_weight',
        'sub_case_weight',
        'usda_componenent_serving_fruit',
        'usda_componenent_serving_milk',
        'usda_componenent_serving_grain',
        'usda_componenent_serving_meat',
        'usda_componenent_serving_veg',
        'usda_componenent_serving_veggrn',
        'usda_componenent_serving_vegleg',
        'usda_componenent_serving_vegothr',
        'usda_componenent_serving_vegred',
        'usda_componenent_serving_vegstar',
        'case_quantity',
        'sub_case_quantity',
        'primary_category_id',
        'primary_sub_category_id',
        'yield',
        'gtin',
        'manufacturer_sku',
        'manufacturer',
        'name',
        'cn_code',

        // 2021_10_26_233808_add_fields_to_products_table.php
        'gtin_number',
        'pct_yield',
        'sort',
        'is_commodity',
        'is_kosher',
        'can_use_for_ingredient',
        'user_id',
    ];

    protected $casts = [
        'is_commodity' => 'boolean',
        'is_kosher' => 'boolean',
        'can_use_for_ingredient' => 'boolean',
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
    protected static function scopeByComponent(Builder $query, Component $component): Builder
    {
        return $query->with(['components' => function ($query) use ($component) {
            $query->findOrFail($component->id);
        }]);
    }

    public function scopeSearchByName(Builder $query, $search = null): Builder
    {
        if($search && $search != ''){
            $query->where(function($q) use($search){
                $q->whereRaw("LOWER(name) LIKE '%".strtolower($search)."%'");
                $q->orWhereRaw("LOWER(manufacturer_sku) LIKE '%".strtolower($search)."%'");
                $q->orWhereHas('tags', function($q1) use($search){
                    $q1->whereRaw("LOWER(name) LIKE '%".strtolower($search)."%'");
                });
            });
        }
        return $query;
    }

    public  function scopeAllProduct(Builder $query, $is_all = null): Builder
    {
        // dd($is_all);
        if(!$is_all){
            $query->where(function($q){
                $q->whereNotNull('usda_componenent_serving_meat')
                ->orWhereNotNull('usda_componenent_serving_grain')
                ->orWhereNotNull('usda_componenent_serving_fruit')
                ->orWhereNotNull('usda_componenent_serving_veg')
                ->orWhereNotNull('usda_componenent_serving_vegleg')
                ->orWhereNotNull('usda_componenent_serving_vegred')
                ->orWhereNotNull('usda_componenent_serving_veggrn')
                ->orWhereNotNull('usda_componenent_serving_vegstar')
                ->orWhereNotNull('usda_componenent_serving_vegothr')
                ->orWhereNotNull('usda_componenent_serving_milk')
                
                ;
            });
        }
        return $query;
    }


    //=============================================================================
    // Relationships
    // - https://laravel.com/docs/8.x/eloquent-relationships
    // - https://hackernoon.com/eloquent-relationships-cheat-sheet-5155498c209
    //=============================================================================
    public function distributor(): BelongsTo
    {
        return $this->belongsTo(Distributor::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function allergens(): BelongsToMany
    {
        return $this->belongsToMany(Allergen::class);
    }

    public function components(): BelongsToMany
    {
        return $this->belongsToMany(Component::class);
    }

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function ingredients(): BelongsToMany
    {
        return $this->belongsToMany(Ingredient::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'categories_product');
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

    public function getAllergensNameAttribute(){
        $name = $this->allergens()->get()->pluck('name')->toArray();
        return implode(' , ', $name);
    }

    public function getTenantNameAttribute(){
        $name = $this->tenant_id;
        if($this->tenant_id){
            $t = Tenant::where('id', $name)->first();
            if($t)
                $name = !is_null($t->name)? $t->name : $name;
        }
        return $name;
    }

    public function getIsUsdaAttribute()
    {
        if(
            is_null($this->usda_componenent_serving_meat) 
            && is_null($this->usda_componenent_serving_grain)
            && is_null($this->usda_componenent_serving_vegstar) 
            && is_null($this->usda_componenent_serving_fruit) 
            && is_null($this->usda_componenent_serving_veg) 
            && is_null($this->usda_componenent_serving_vegleg) 
            && is_null($this->usda_componenent_serving_vegred) 
            && is_null($this->usda_componenent_serving_veggrn) 
            && is_null($this->usda_componenent_serving_vegothr)
            && is_null($this->usda_componenent_serving_milk)

        )
        {
            return false;
        }
        return true;
    }


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
