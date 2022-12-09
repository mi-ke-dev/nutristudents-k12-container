<?php


namespace Bytelaunch\Nutristudents\Actions\Recipes;


use Bytelaunch\Nutristudents\Models\Ingredient;
use Bytelaunch\Nutristudents\Models\Recipe;

class SyncIngredientAction
{

    private $ingredients = [];
    private Recipe $recipe;


    public function forRecipe(Recipe $recipe): self
    {
        $this->recipe = $recipe;
        return $this;
    }

    public function attachIngredient($ingredient, $component_data): self
    {
        // todo
        //dd($ingredient, $component_data);

        for ($i = 0; $i < count($ingredient); $i++) {
            $this->ingredients[$ingredient[$i]->id] = $component_data[$i];
        }

        return $this;
    }


    public function attachIngredients($ingredient): self
    {
        $this->ingredients = $ingredient;
        return $this;
    }

    public function attach(): Recipe
    {
        if (count($this->ingredients) > 0) {
            //$this->recipe->ingredients()->sync(collect($this->ingredients)->pluck('id')->toArray());
            $this->recipe->ingredients()->sync($this->ingredients);
        } else {
            $this->recipe->ingredients()->sync([]);
        }

        return $this->recipe;
    }


}
