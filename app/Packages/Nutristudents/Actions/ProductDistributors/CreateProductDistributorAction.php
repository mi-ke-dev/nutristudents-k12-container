<?php


namespace Bytelaunch\Nutristudents\Actions\ProductDistributors;

use Bytelaunch\Nutristudents\Getters\Tenants\GetCurrentTenantGetter;
use Bytelaunch\Nutristudents\Models\Distributor;

class CreateProductDistributorAction
{
    private string $name;

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }


    public function create(): Distributor
    {
        $tenant_id = (new GetCurrentTenantGetter)->first()->id;

        $distributor = Distributor::create([
            'tenant_id' => $tenant_id, 
            'name' => $this->name,
        ]);

        return $distributor;
    }
}
