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

class AttachComponentAction
{

    private Ingredient $ingredient;
    private Component $component;


    public function forIngredient(Ingredient $ingredient) : self
    {
        $this->ingredient = $ingredient;
        return $this;
    }

    public function attachComponent(Component $component): self
    {
        $this->component = $component;
        return $this;
    }

    public function attach() : Ingredient
    {
        $this->ingredient->component()->associate($this->component)->save();

        return $this->ingredient;
    }




}
