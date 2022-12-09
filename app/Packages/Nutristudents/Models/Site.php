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
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use App\Models\User;
use Bytelaunch\Nutristudents\Models\Group;

class Site extends Model
{
    //use HasUuid;
    use HasFactory;
    use Uuid;

    protected $casts = [
        //
    ];

    protected $fillable = [
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


    protected $appends = ['is_view','is_edit', 'is_menu_edit', 'is_order_edit', 'is_student_counts'];

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
    public function grades(): HasMany
    {
        return $this->hasMany(Grade::class);
    }

    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class);
    }    

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withPivot('can_view','can_admin','can_menu_edit','can_order_edit','can_add_student_counts');
    }

    public function offerings(): BelongsToMany
    {
        return $this->belongsToMany(Offering::class);
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


    public function getIsViewAttribute()
    {
        $user = auth()->user();
        if($user){
            $siteuser = $this->users()->where('site_user.user_id', $user->id)->first();
            
            if($siteuser && $siteuser->pivot->can_view){
                return true;
            }
        } 
      return false;
    }

    public function getIsEditAttribute()
    {
        $user = auth()->user();
        if($user){
            $siteuser = $this->users()->where('site_user.user_id', $user->id)->first();
            if($siteuser && $siteuser->pivot->can_admin){
                return true;
            }
        } 
      return false;
    }

    public function getIsMenuEditAttribute()
    {
        $user = auth()->user();
        if($user){
            $siteuser = $this->users()->where('site_user.user_id', $user->id)->first();
            
            if($siteuser && $siteuser->pivot->can_menu_edit){
                return true;
            }
        } 
      return false;
    }

    public function getIsOrderEditAttribute()
    {
        $user = auth()->user();
        if($user){
            $siteuser = $this->users()->where('site_user.user_id', $user->id)->first();
            
            if($siteuser && $siteuser->pivot->can_order_edit){
                return true;
            }
        } 
      return false;
    }


    public function getIsStudentCountsAttribute()
    {
        $user = auth()->user();
        if($user){
            $siteuser = $this->users()->where('site_user.user_id', $user->id)->first();
            
            if($siteuser && $siteuser->pivot->can_add_student_counts){
                return true;
            }
        } 
      return false;
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

    public function headcounts(){
        return $this->hasMany(UserPermission::class)->where('type', 'headcounts');
    }

    public function menu_planings(){
        return $this->hasMany(UserPermission::class)->where('type', 'menu_planings');
    }

    public function food_preparation(){
        return $this->hasMany(UserPermission::class)->where('type', 'food_preparation');
    }
}
