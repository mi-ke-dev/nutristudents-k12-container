<?php

namespace App\Observers;

use App\Models\Tenant;

class TenantObserver
{
    /**
     * Handle the Tenant "creating" event.
     *
     * @param  \App\Models\Tenant  $tenant
     * @return void
     */
    public function creating(Tenant $tenant)
    {
        if (!$tenant->source_tenant) {
            $sourceTenant = Tenant::where('is_primary', true)->first();
            if($sourceTenant){
                $tenant->source_tenant = $sourceTenant->id;
            }
            
        }
    }

    /**
     * Handle the Tenant "created" event.
     *
     * @param  \App\Models\Tenant  $tenant
     * @return void
     */
    public function created(Tenant $tenant)
    {
        if ($tenant->is_primary) {
            Tenant::where('is_primary')->update(['is_primary' => false]);
            $tenant->is_primary = true;
            $tenant->saveQuietly();
        }
    }

    /**
     * Handle the Tenant "updated" event.
     *
     * @param  \App\Models\Tenant  $tenant
     * @return void
     */
    public function updated(Tenant $tenant)
    {
        if ($tenant->wasChanged('is_primary') && $tenant->is_primary) {
            Tenant::where('is_primary', true)->update(['is_primary' => false]);
            $tenant->is_primary = true;
            $tenant->saveQuietly();
        }
    }

    /**
     * Handle the Tenant "deleted" event.
     *
     * @param  \App\Models\Tenant  $tenant
     * @return void
     */
    public function deleted(Tenant $tenant)
    {
        //
    }

    /**
     * Handle the Tenant "restored" event.
     *
     * @param  \App\Models\Tenant  $tenant
     * @return void
     */
    public function restored(Tenant $tenant)
    {
        //
    }

    /**
     * Handle the Tenant "force deleted" event.
     *
     * @param  \App\Models\Tenant  $tenant
     * @return void
     */
    public function forceDeleted(Tenant $tenant)
    {
        //
    }
}
