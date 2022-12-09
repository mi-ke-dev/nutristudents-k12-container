<?php


namespace Bytelaunch\Nutristudents\Actions\Recipes;

use Bytelaunch\Nutristudents\Getters\Tenants\GetCurrentTenantGetter;
use Bytelaunch\Nutristudents\Models\Allergen;
use Bytelaunch\Nutristudents\Models\Component;
use Bytelaunch\Nutristudents\Models\Distributor;
use Bytelaunch\Nutristudents\Models\Ingredient;
use Bytelaunch\Nutristudents\Models\Product;
use Bytelaunch\Nutristudents\Models\Recipe;
use Bytelaunch\Nutristudents\Models\Tag;
use Bytelaunch\Nutristudents\Models\UnitOfMeasurement;
use SebastianBergmann\CodeCoverage\Report\Xml\Unit;
use Illuminate\Support\Facades\DB;

class CopyRecipeAction
{

    private Recipe $recipe;

    public function sourceRecipe(Recipe $recipe) : self
    {
        $this->recipe = $recipe;                
        return $this;
    }

    public function copy()
    {   
        
        $newRecipe = $this->recipe->replicate();
        $newRecipe->name .= ' (Copy)';
        $newRecipe->tenant_id = (new GetCurrentTenantGetter)->first()->id;
        
        $newRecipe->save();
        
        //$newRecipe->ingredients()->saveMany($this->recipe->ingredients);

        //copy ingredient_recipe data as well with new recipe id
        $this->copyIngredientRecipeData($this->recipe->id, $newRecipe->id);

        return $newRecipe;

    }


    public function copyIngredientRecipeData($rec_id, $new_recipe_id)
    {
        $rec_ing_data = DB::table('ingredient_recipe')->where('recipe_id', $rec_id)->get();
        foreach($rec_ing_data as $rec_ing){
            
        DB::table('ingredient_recipe')->insert([
          'ingredient_id' => $rec_ing->ingredient_id,
          'recipe_id' => $new_recipe_id,
          'recipe_amount' => $rec_ing->recipe_amount,
          'recipe_amount_uom_id' => $rec_ing->recipe_amount_uom_id,
          'serving_amount' => $rec_ing->serving_amount,
          'serving_amount_uom_id' => $rec_ing->serving_amount_uom_id,
          'usda_componenent_meat' => $rec_ing->usda_componenent_meat,
          'usda_componenent_grain' => $rec_ing->usda_componenent_grain,
          'usda_componenent_fruit' => $rec_ing->usda_componenent_fruit,
          'usda_componenent_milk' => $rec_ing->usda_componenent_milk,
          'usda_componenent_veg' => $rec_ing->usda_componenent_veg,
          'usda_componenent_veggrn' => $rec_ing->usda_componenent_veggrn,
          'usda_componenent_vegred' => $rec_ing->usda_componenent_vegred,
          'usda_componenent_vegleg' => $rec_ing->usda_componenent_vegleg,
          'usda_componenent_vegstar' => $rec_ing->usda_componenent_vegstar,
          'usda_componenent_vegothr' => $rec_ing->usda_componenent_vegothr,
          'usda_componenent_meat_override' => $rec_ing->usda_componenent_meat_override,
          'usda_componenent_grain_override' => $rec_ing->usda_componenent_grain_override,
          'usda_componenent_fruit_override' => $rec_ing->usda_componenent_fruit_override,
          'usda_componenent_milk_override' => $rec_ing->usda_componenent_milk_override,
          'usda_componenent_veg_override' => $rec_ing->usda_componenent_veg_override,
          'usda_componenent_veggrn_override' => $rec_ing->usda_componenent_veggrn_override,
          'usda_componenent_vegred_override' => $rec_ing->usda_componenent_vegred_override,
          'usda_componenent_vegleg_override' => $rec_ing->usda_componenent_vegleg_override,
          'usda_componenent_vegstar_override' =>$rec_ing->usda_componenent_vegstar_override,
          'usda_componenent_vegothr_override' =>$rec_ing->usda_componenent_vegothr_override,
        ]);  
        }
        
    }






}
