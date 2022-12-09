<?php


namespace Bytelaunch\Nutristudents\Actions\Tenants;

use Bytelaunch\Nutristudents\Getters\Tenants\GetCurrentTenantGetter;
use Bytelaunch\Nutristudents\Models\Category;
use Bytelaunch\Nutristudents\Models\Distributor;
use Bytelaunch\Nutristudents\Models\Guideline;
use Bytelaunch\Nutristudents\Models\Haccp;
use Bytelaunch\Nutristudents\Models\Ingredient;
use Bytelaunch\Nutristudents\Models\MenuCycle;
use Bytelaunch\Nutristudents\Models\Product;
use Bytelaunch\Nutristudents\Models\Recipe;

class SetTenantsIdAction
{    
    
    public function add()
    {
        $tenant_id = (new GetCurrentTenantGetter())->first()->id;
        MenuCycle::whereNull('tenant_id')->update(['tenant_id'=> $tenant_id]);  
        Recipe::whereNull('tenant_id')->update(['tenant_id'=> $tenant_id]);  
        Ingredient::whereNull('tenant_id')->update(['tenant_id'=> $tenant_id]);  
        Product::whereNull('tenant_id')->update(['tenant_id'=> $tenant_id]);  
        Guideline::whereNull('tenant_id')->update(['tenant_id'=> $tenant_id]);  
        Category::whereNull('tenant_id')->update(['tenant_id'=> $tenant_id]);  
        Distributor::whereNull('tenant_id')->update(['tenant_id'=> $tenant_id]);  
        Haccp::whereNull('tenant_id')->update(['tenant_id'=> $tenant_id]);        
    }
}
