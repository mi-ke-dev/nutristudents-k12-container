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


class UpdateCurrentTenantsDataAction
{

    public function add()
    {

        $masterTenant = Tenant::where('is_master_release', true)->first();
        $subTenant = (new GetCurrentTenantGetter)->first();
        if($subTenant  && !$subTenant->is_master_release && $masterTenant){

            if($subTenant->last_updated_at <= $masterTenant->last_updated_at || is_null($subTenant->last_updated_at)){
                try {
                    
                    SetTenantData::dispatch($masterTenant->tenancy_db_name, $subTenant->tenancy_db_name);
                    $subTenant->last_updated_at = date('Y-m-d H:i:s');
                    $subTenant->save();
                } catch (\Exception $th) {
                    echo "Error ". $th->getMessage();
                }
            }
        }

        // dd("last relege");


    }

}
