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

class DeleteIngredientAction
{

    private Ingredient $ingredient;

    public function sourceIngredient(Ingredient $ingredient) : self
    {
        $this->ingredient = $ingredient;
        return $this;
    }

    public function delete()
    {
        if ($this->ingredient->products->count() > 0) {
            $this->ingredient->products()->detach();
        }

        $this->ingredient->delete();

    }

}
