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


class UpdateRecipeAction
{

    private string $name;
    private ?string $recipeNum = null;
    private string $category;
    private int $recipePortion;
    private ?string $recipePortionUom = null;
    private float $servingSize;
    private ?string $servingSizeUom = null;
    private string $cookingInstructions;
    private ?string $haccpId = null;
    private $ingredients = [];
    private bool $is_favorite = false;

    private Recipe $recipe;

    public function setRecipe(Recipe $recipe): self
    {
        $this->recipe = $recipe;
        return $this;
    }

    public function setSimplifiedName( $simplified_name) : self
    {
        $this->recipe->simplified_name = $simplified_name;
        return $this;
    }

    public function setIsFavorite(bool $is_favorite) : self
    {
        $this->recipe->is_favorite = $is_favorite;
        return $this;
    }

    public function setName(string $name): self
    {
        $this->recipe->name = $name;
        return $this;
    }

    public function setRecipeNum(string $recipeNum): self
    {
        $this->recipe->ns_recipe = $recipeNum;
        return $this;
    }

    public function setCategory(string $category): self
    {
        $this->recipe->category = $category;
        return $this;
    }

    public function setRecipePortion(int $recipePortion): self
    {
        $this->recipe->portion = $recipePortion;
        return $this;
    }

    public function setServingSize(float $servingSize): self
    {
        $this->recipe->serving_size = $servingSize;        
        return $this;
    }

    public function setServingSizeUom(string $servingSizeUom = null): self
    {
        $this->recipe->serving_size_uom_id = $servingSizeUom;
        return $this;
    }

    public function setCookingInstructions(string $cookingInstructions): self
    {
        $this->recipe->cooking_instructions = $cookingInstructions;
        return $this;
    }

    public function setHaccpId(string $haccpId = null): self
    {
        $this->recipe->haccp_id = $haccpId;
        return $this;
    }

    public function addIngredient(Ingredient $ingredient, $component_data): self
    {
        // today

        $this->component_data[] = $component_data;
        $this->ingredients[] = $ingredient;
        return $this;
    }

    public function update(): Recipe
    {
        $this->recipe->save();

        $recipe = $this->recipe;

        if (count($this->ingredients) > 0) {
            $recipe = (new SyncIngredientAction())
                ->forRecipe($recipe)
                ->attachIngredient($this->ingredients, $this->component_data)
                ->attach();
        }else{
            //condition for remove attached ingredients in recipe in edit only...
            $recipe = (new SyncIngredientAction())
                ->forRecipe($recipe)
                ->attachIngredients($this->ingredients)
                ->attach();
        }

        return $recipe;
    }


}
