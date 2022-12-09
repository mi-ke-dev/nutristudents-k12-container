<?php


namespace Bytelaunch\Nutristudents\Actions\Ingredients;


use Bytelaunch\Nutristudents\Models\Allergen;
use Bytelaunch\Nutristudents\Models\Component;
use Bytelaunch\Nutristudents\Models\Distributor;
use Bytelaunch\Nutristudents\Models\Ingredient;
use Bytelaunch\Nutristudents\Models\Product;
use Bytelaunch\Nutristudents\Models\Tag;
use Bytelaunch\Nutristudents\Models\UnitOfMeasurement;
use SebastianBergmann\CodeCoverage\Report\Xml\Unit;

class AttachProductAction
{

    private Ingredient $ingredient;
    private $products = [];


    public function forIngredient(Ingredient $ingredient) : self
    {
        $this->ingredient = $ingredient;
        return $this;
    }

    public function attachProduct(Product $product): self
    {
        $this->products[] = $product;
        return $this;
    }

    public function attach() : Ingredient
    {
        if (count($this->products) > 0) {
            $this->ingredient->products()->saveMany($this->products);
        }

        return $this->ingredient;
    }



}
