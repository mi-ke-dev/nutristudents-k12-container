<?php


namespace Bytelaunch\Nutristudents\Actions\Distributors;


use Bytelaunch\Nutristudents\Models\Distributor;
use Bytelaunch\Nutristudents\Models\Site;

class CreateDistributorAction
{
    private string $name;

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }


    public function create(): Distributor
    {
        $distributor = Distributor::create([
            'name' => $this->name,
        ]);

        return $distributor;
    }
}
