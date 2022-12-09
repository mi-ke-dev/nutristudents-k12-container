<?php
namespace Bytelaunch\Nutristudents\Getters\Tenants;

use App\Models\Tenant;

class GetCurrentTenantGetter
{
    public function first() {
        return Tenant::whereRelation('domains','domain',request()->getHost())->first();  
    }
}
?>
