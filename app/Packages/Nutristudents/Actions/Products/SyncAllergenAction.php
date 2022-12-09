<?php


namespace Bytelaunch\Nutristudents\Actions\Products;


use Bytelaunch\Nutristudents\Models\Allergen;
use Bytelaunch\Nutristudents\Models\Component;
use Bytelaunch\Nutristudents\Models\Distributor;
use Bytelaunch\Nutristudents\Models\Product;
use Bytelaunch\Nutristudents\Models\Tag;
use Bytelaunch\Nutristudents\Models\UnitOfMeasurement;
use SebastianBergmann\CodeCoverage\Report\Xml\Unit;

class SyncAllergenAction
{

    private $allergens = [];
    private Product $product;


    public function forProduct(Product $product) : self
    {
        $this->product = $product;
        return $this;
    }

    public function attachAllergen(Allergen $allergen): self
    {
        $this->allergens[] = $allergen;
        return $this;
    }


    public function attachAllergens($allergens): self
    {
        $this->allergens = $allergens;
        return $this;
    }

    public function attach() : Product
    {
        if (count($this->allergens) > 0) {
            $this->product->allergens()->sync(collect($this->allergens)->pluck('id')->toArray());
        }else{
            $this->product->allergens()->sync([]);
        }

        return $this->product;
    }



}
