<?php

namespace App\Models;

use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains;

    protected $fillable = [
        'id', // 👈 Must be present
        'is_primary',
        'source_tenant',
        'last_updated_at',
        'is_master_release',
        'name'
    ];

    protected $casts = [
        'is_primary' => 'boolean',
        'is_master_release' => 'boolean'
    ];

    public static function getCustomColumns(): array
    {
        return [
            'id',
            'is_primary',
            'source_tenant',
        ];
    }
}
