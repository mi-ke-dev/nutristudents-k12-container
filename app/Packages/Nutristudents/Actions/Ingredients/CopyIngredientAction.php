<?php


namespace Bytelaunch\Nutristudents\Actions\Ingredients;

use Bytelaunch\Nutristudents\Getters\Tenants\GetCurrentTenantGetter;
use Bytelaunch\Nutristudents\Models\Allergen;
use Bytelaunch\Nutristudents\Models\Component;
use Bytelaunch\Nutristudents\Models\Distributor;
use Bytelaunch\Nutristudents\Models\Ingredient;
use Bytelaunch\Nutristudents\Models\Product;
use Bytelaunch\Nutristudents\Models\Tag;
use Bytelaunch\Nutristudents\Models\UnitOfMeasurement;
use SebastianBergmann\CodeCoverage\Report\Xml\Unit;

class CopyIngredientAction
{

    private Ingredient $ingredient;

    public function sourceIngredient(Ingredient $ingredient) : self
    {
        $this->ingredient = $ingredient;
        return $this;
    }

    public function copy()
    {
        // dd($this->ingredient->products->pluck('id'));
        $newIngredient = $this->ingredient->replicate();
        $newIngredient->name .= ' (Copy)';
        $newIngredient->tenant_id = (new GetCurrentTenantGetter)->first()->id;
        $newIngredient->save();
        foreach($this->ingredient->products as $p)
        {
            $newIngredient->products()->save($p);
        }
        $pid = $this->ingredient->products->pluck('id')->toArray();
        if(count($pid) > 0)
        {
            $newIngredient->products()->sync($pid);
        }
        

        return $newIngredient;

    }






}
