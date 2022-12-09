<?php

declare(strict_types=1);

namespace Bytelaunch\Nutristudents\Models;

use Bytelaunch\Nutristudents\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class MenuCreationGroupOffering extends Model
{
    //use HasUuid;
    //use HasFactory;

    protected $fillable = [
        'offering_id',
        'menu_creation_group_id'
    ];

    protected $table="menu_creation_group_offerings";

    public function menu_creation_group(): BelongsToMany
    {
        return $this->belongsToMany(MenuCreationGroup::class);
    }
    
}
