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

class Distributor extends Model
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
        'name'
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
    public function products(): HasOne
    {
        return $this->hasOne(Product::class);
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
