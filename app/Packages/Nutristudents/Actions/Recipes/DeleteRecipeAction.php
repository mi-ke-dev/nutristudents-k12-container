<?php


namespace Bytelaunch\Nutristudents\Actions\Recipes;


use Bytelaunch\Nutristudents\Models\Allergen;
use Bytelaunch\Nutristudents\Models\Component;
use Bytelaunch\Nutristudents\Models\Distributor;
use Bytelaunch\Nutristudents\Models\Ingredient;
use Bytelaunch\Nutristudents\Models\Product;
use Bytelaunch\Nutristudents\Models\Recipe;
use Bytelaunch\Nutristudents\Models\Tag;
use Bytelaunch\Nutristudents\Models\UnitOfMeasurement;
use SebastianBergmann\CodeCoverage\Report\Xml\Unit;

class DeleteRecipeAction
{

    private Recipe $recipe;

    public function sourceRecipe(Recipe $recipe) : self
    {
        $this->recipe = $recipe;
        return $this;
    }

    public function deleteRecipe()
    {

        if($this->recipe->ingredients->count() > 0){
            $this->recipe->ingredients()->detach();
        }

        $this->recipe->delete();

    }

}
