<?php


namespace Bytelaunch\Nutristudents\Traits;

use Bytelaunch\Nutristudents\Getters\Tenants\GetCurrentTenantGetter;
// use Illuminate\Support\Str;

trait HasTenantAdmin
{
    
    /**
     * Get the value indicating whether the IDs are incrementing.
     *
     * @return bool
     */
    public function getIsTenantAdminAttribute(){
        if(is_null($this->tenant_id)){
            return true;
        }
        $tenant = (new GetCurrentTenantGetter)->first();        
        if($tenant){
            return $tenant->id == $this->tenant_id;
        }
        return false;
    }
}
