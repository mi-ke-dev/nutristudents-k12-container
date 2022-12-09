<?php

namespace Bytelaunch\Nutristudents\Models;

use Bytelaunch\Nutristudents\Traits\Uuid;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Days extends Model
{

    //use HasUuid;
    use HasFactory;
    use Uuid;

    protected $casts = [
        //
    ];

    protected $appends = ['total_days'];
    protected $fillable = [
        'name',
        'mon',
        'tue',
        'wed',
        'thu',
        'fri',
        'sat',
        'sun',
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
        return $this->HasMany(MenuCycle::class);
    }

    public function getTotalDaysAttribute(){
        return $this->mon + $this->tue + $this->wed + $this->thu + $this->fri + $this->sat + $this->sun; 
    }
}
