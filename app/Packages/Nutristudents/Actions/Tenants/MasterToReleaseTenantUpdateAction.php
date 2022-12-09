<?php


namespace Bytelaunch\Nutristudents\Actions\Tenants;

use App\Jobs\SetTenantData;
use App\Models\Tenant;
use Bytelaunch\Nutristudents\Getters\Tenants\GetCurrentTenantGetter;
use Bytelaunch\Nutristudents\Models\Category;
use Bytelaunch\Nutristudents\Models\Distributor;
use Bytelaunch\Nutristudents\Models\Guideline;
use Bytelaunch\Nutristudents\Models\Haccp;
use Bytelaunch\Nutristudents\Models\Ingredient;
use Bytelaunch\Nutristudents\Models\MenuCycle;
use Bytelaunch\Nutristudents\Models\Product;
use Bytelaunch\Nutristudents\Models\Recipe;
use Illuminate\Support\Facades\DB;
use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\Bus;
use Throwable;

class MasterToReleaseTenantUpdateAction
{   
    
    public function add()
    {
        
        $masterTenant = Tenant::where('is_primary', true)->first()->tenancy_db_name;
        $subTenant = Tenant::where('is_master_release', true)->first();
        if($masterTenant && $subTenant){
            try {
                SetTenantData::dispatch($masterTenant, $subTenant->tenancy_db_name);
                $subTenant->last_updated_at = date('Y-m-d H:i:s');
                $subTenant->save();
                // dd($subTenant->toArray());
                
            } catch (\Exception $th) {
                echo "Error ". $th->getMessage();
            }
        } else {
            echo "Error Master or subtenet not found";
        }   
    }

}
