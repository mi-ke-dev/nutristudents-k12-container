<?php


namespace Bytelaunch\Nutristudents\Actions\ProductDistributors;

use Bytelaunch\Nutristudents\Models\Distributor;

class DeleteProductDistributorAction
{
    private Distributor $distributor;

    public function sourceDistributor(Distributor $distributor) : self
    {
        $this->distributor = $distributor;
        return $this;
    }

    public function deleteDistributor()
    {
        $this->distributor->delete();
    }

}
