<?php


namespace Bytelaunch\Nutristudents\Actions\Recipes;


use Bytelaunch\Nutristudents\Models\Ingredient;
use Bytelaunch\Nutristudents\Models\Recipe;

class AttachIngredientAction
{

    private $ingredients = [];

    private Recipe $recipe;


    public function forRecipe(Recipe $recipe) : self
    {
        $this->recipe = $recipe;
        return $this;
    }

    public function attachIngredient($ingredient, $component_data): self
    {
        // todo        
        if(!empty($component_data) && isset($component_data[0]['recipe_amount'])){
        for($i = 0; $i < count($ingredient); $i++){
           $this->ingredients[$ingredient[$i]->id] = $component_data[$i];
        }    
        }
            
        return $this;
        
    }


    public function attachIngredients($ingredient): self
    {
        $this->ingredients = $ingredient;
        return $this;
    }

    public function attach() : Recipe
    {
        
        if (count($this->ingredients) > 0 ) {
            $this->recipe->ingredients()->attach($this->ingredients);
           //$this->recipe->ingredients()->saveMany($this->ingredients);
        }else{
            $this->recipe->ingredients()->detach();
        }

        return $this->recipe;
    }


}
