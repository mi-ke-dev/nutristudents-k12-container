<?php


namespace Bytelaunch\Nutristudents\Actions\Products;


use Bytelaunch\Nutristudents\Models\Allergen;
use Bytelaunch\Nutristudents\Models\Component;
use Bytelaunch\Nutristudents\Models\Distributor;
use Bytelaunch\Nutristudents\Models\Ingredient;
use Bytelaunch\Nutristudents\Models\Product;
use Bytelaunch\Nutristudents\Models\Recipe;
use Bytelaunch\Nutristudents\Models\Tag;
use Bytelaunch\Nutristudents\Models\UnitOfMeasurement;
use SebastianBergmann\CodeCoverage\Report\Xml\Unit;

class DeleteProductAction
{

    private Product $product;

    public function sourceProduct(Product $product) : self
    {
        $this->product = $product;
        return $this;
    }

    public function deleteProduct()
    {

        if($this->product->allergens->count() > 0){
            $this->product->allergens()->detach();
        }

        if($this->product->components->count() > 0){
            $this->product->components()->detach();
        }

        if ($this->product->tags->count() > 0) {
            $this->product->tags()->detach();
        }

        $this->product->delete();

    }






}
