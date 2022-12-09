<?php


namespace Bytelaunch\Nutristudents\Getters\Recipes;


use Bytelaunch\Nutristudents\Models\Recipe;

class RecipeHasPhoto
{
    private Recipe $recipe;

    public function forRecipe(Recipe $recipe) : self
    {
        $this->recipe = $recipe;
        return $this;
    }

    public function get() : bool
    {
        return ($this->recipe && $this->recipe->photo_store_path && $this->recipe->photo_store_path)?true:false;
    }


}
