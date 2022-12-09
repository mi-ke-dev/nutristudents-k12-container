<?php

declare(strict_types=1);

namespace Bytelaunch\Nutristudents\Models;

use App\Models\Booking;
use App\Models\Buyer;
use App\Models\BuyersAgent;
use App\Scopes\OfferScope;
use Bytelaunch\Nutristudents\Enum\CategoryEnum;
use Bytelaunch\Nutristudents\Traits\HasTenantAdmin;
use Bytelaunch\Nutristudents\Traits\Uuid;
use HarcourtsAuctions\PropertyPortal\Database\Factories\OfferFactory;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recipe extends Model
{
    //use HasUuid;
    use HasFactory;
    use Uuid;
    use HasTenantAdmin;
    use SoftDeletes;

    protected $casts = [
        // 'serving_size' => 'decimal:2'
    ];

    protected $appends = ['category_sort', 'custom_id', 'show_name'];

    protected $fillable = [
        'tenant_id',
        'name',
        'ns_recipe',
        'category',        
        'portion',        
        'serving_size',
        'serving_size_uom_id',
        'cooking_instructions',
        'haccp_id',
        'is_favorite',
        'simplified_name'
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
    public function ingredients(): BelongsToMany
    {
        return $this->belongsToMany(Ingredient::class);
    }

    public function ingredient_recipes(): HasMany
    {
        return $this->hasMany(IngredientRecipe::class, 'recipe_id');
    }

    public function ingredients_total(): HasMany
    {
        return $this->hasMany(IngredientRecipe::class);
    }

    public function unitOfMesurment(): BelongsTo
    {
        return $this->belongsTo(UnitOfMeasurement::class,'serving_size_uom_id');
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

    public function getCustomIdAttribute()
    {
      return strtoupper(substr($this->id, -4));
    }

    public function getCategorySortAttribute(){
        return CategoryEnum::getNumber($this->category); 
    }

    public function getShowNameAttribute(){
        if($this->simplified_name && $this->simplified_name != ''){
            return $this->simplified_name;
        } else {
            return $this->name;
        }
    }

    public function getAllergensNameAttribute(){
        if($this->ingredients){
            $name = $this->ingredients()->get()->pluck('prefer_product.allergens_name')->toArray();
            $name = array_filter($name, 'strlen');
            return implode(' , ', $name);
        } else {
            return null;
        }
    }

    public function scopeSearchByAll($query, $search){
        $query->where(function($q) use($search){
            $q->whereRaw("LOWER(name) LIKE '%".strtolower($search)."%'");
            if(!env('IS_LOCAL_SERVER', false)){
                $q->orWhereRaw("LOWER(id::text) LIKE '%".strtolower($search)."%'");
            }
            
        })
        
        
        ;

    }
}
