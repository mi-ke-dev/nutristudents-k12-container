<?php


namespace Bytelaunch\Nutristudents\Actions\Products;


use Bytelaunch\Nutristudents\Models\Allergen;
use Bytelaunch\Nutristudents\Models\Component;
use Bytelaunch\Nutristudents\Models\Distributor;
use Bytelaunch\Nutristudents\Models\Product;
use Bytelaunch\Nutristudents\Models\Tag;
use Bytelaunch\Nutristudents\Models\UnitOfMeasurement;
use SebastianBergmann\CodeCoverage\Report\Xml\Unit;


class AttachComponentAction
{

    private $components = [];
    private Product $product;


    public function forProduct(Product $product) : self
    {
        $this->product = $product;
        return $this;
    }

    public function attachComponent(Component $component, Component $subComponent, $primary = false): self
    {
        // todo

        $this->components[] = $component;
        return $this;
    }


    public function attachComponents($component): self
    {
        $this->components = $component;
        return $this;
    }

    public function attach() : Product
    {
        if (count($this->components) > 0) {
            $this->product->components()->saveMany($this->components);
        }

        return $this->product;
    }



}
