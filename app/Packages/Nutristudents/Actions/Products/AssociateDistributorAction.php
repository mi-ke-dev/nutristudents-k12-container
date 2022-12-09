<?php


namespace Bytelaunch\Nutristudents\Actions\Products;


use Bytelaunch\Nutristudents\Models\Tag;
use Bytelaunch\Nutristudents\Models\Component;
use Bytelaunch\Nutristudents\Models\Distributor;
use Bytelaunch\Nutristudents\Models\Product;
use Bytelaunch\Nutristudents\Models\UnitOfMeasurement;
use SebastianBergmann\CodeCoverage\Report\Xml\Unit;

class AssociateDistributorAction
{

    private Product $product;
    private Distributor $distributor;


    public function forProduct(Product $product): self
    {
        $this->product = $product;
        return $this;
    }

    public function setDistributor(Distributor $distributor): self
    {
        $this->distributor = $distributor;
        return $this;
    }


    public function associate(): Product
    {
        $this->product
            ->distributor()
            ->associate($this->distributor)
            ->save();

        return $this->product;
    }


}
