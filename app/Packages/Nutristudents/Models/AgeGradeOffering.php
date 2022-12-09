<?php

namespace Bytelaunch\Nutristudents\Models;

use Bytelaunch\Nutristudents\Traits\Uuid;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AgeGradeOffering extends Model
{

    //use HasUuid;
    use HasFactory;
    use Uuid;

    protected $casts = [
        //
    ];

    protected $fillable = [
        'name',
        'type',
        'starting',
        'ending'
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

    public function menu_cycles(): HasMany
    {
        return $this->HasMany(MenuCycle::class, 'age_grade_id');
    }
}
