<?php


namespace Bytelaunch\Nutristudents\Actions\ProductDistributors;

use Bytelaunch\Nutristudents\Models\Distributor;

class UpdateProductDistributorAction
{
    private string $name;
    private Distributor $distributor;

    public function setDistributor(Distributor $distributor): self
    {
        $this->distributor = $distributor;
        return $this;
    }

    public function setName(string $name): self
    {
        $this->distributor->name = $name;
        return $this;
    }


    public function update(): Distributor
    {
        $this->distributor->save();
        $distributor = $this->distributor;
        return $distributor;
    }
}
