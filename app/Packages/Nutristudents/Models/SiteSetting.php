<?php

namespace Bytelaunch\Nutristudents\Models;
use Bytelaunch\Nutristudents\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use Uuid;
    use HasFactory;
    protected $fillable = [
        'label','value'
    ];
}
