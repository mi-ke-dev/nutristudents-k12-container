<?php

declare(strict_types=1);

namespace Bytelaunch\Nutristudents\Models;

use Bytelaunch\Nutristudents\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OfferingSite extends Model
{
    //use HasUuid;
    use HasFactory;

    protected $table="offering_site";

    public function site(): BelongsTo
    {
        return $this->belongsTo(Site::class, 'site_id');
    }

    public function offering(): BelongsTo
    {
        return $this->belongsTo(Offering::class,'offering_id');
    }
    
}
