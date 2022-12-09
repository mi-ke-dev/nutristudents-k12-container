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

class CreateRecipeAction
{

    private string $name;
    private ?string $recipeNum = null;
    private string $category;
    private int $recipePortion;
    private ?string $recipePortionUomId = null;
    private float $servingSize;
    private ?string $servingSizeUomId = null;
    private string $cookingInstructions;
    private ?string $haccpId = null;
    private $ingredients = [];
    private $component_data = [];
    private bool $is_favorite = false;
    private ?string $simplified_name = null;

    private float $amount;
    private ?string $amount_uom = null;
    private float $component_mma;
    private float $component_wgr;
    private float $component_fru;
    private float $component_mlk;
    private float $component_veg;

    // setSimplifiedName
    public function setSimplifiedName( $simplified_name) : self
    {
        $this->simplified_name = $simplified_name;
        return $this;
    }

    public function setName(string $name) : self
    {
        $this->name = $name;
        return $this;
    }

    public function setIsFavorite(bool $is_favorite) : self
    {
        $this->is_favorite = $is_favorite;
        return $this;
    }

    

    public function setRecipeNum(string $recipeNum) : self
    {
        $this->recipeNum = $recipeNum;
        return $this;
    }

    public function setCategory(string $category) : self
    {
        $this->category = $category;
        return $this;
    }

    public function setRecipePortion(int $recipePortion) : self
    {
        $this->recipePortion = $recipePortion;
        return $this;
    }    

    public function setServingSize(float $servingSize) : self
    {
        $this->servingSize = $servingSize;
        return $this;
    }

    public function setServingSizeUom(string $servingSizeUom = null) : self
    {
        $this->servingSizeUomId = $servingSizeUom;
        return $this;
    }

    public function setCookingInstructions(string $cookingInstructions) : self
    {
        $this->cookingInstructions = $cookingInstructions;
        return $this;
    }

    public function setHaccpId(string $haccpId = null) : self
    {
        $this->haccpId = $haccpId;
        return $this;
    }

    public function addIngredient(Ingredient $ingredient, $component_data) : self
    {
        // today                
        $this->component_data[] = $component_data;

        $this->ingredients[] = $ingredient;
        return $this;
    }

    public function create() : Recipe
    {
        $tenant_id = (new GetCurrentTenantGetter)->first()->id;
        $recipe = Recipe::create([
            'tenant_id' => $tenant_id,     
            'name' => $this->name,
            'ns_recipe' => $this->recipeNum,
            'category' => $this->category,
            'portion' => $this->recipePortion,            
            'serving_size' => $this->servingSize,
            'serving_size_uom_id' => $this->servingSizeUomId,
            'cooking_instructions' => $this->cookingInstructions,
            'haccp_id' => $this->haccpId,
            'is_favorite' => $this->is_favorite,
            'simplified_name' => $this->simplified_name
        ]);


        if (count($this->ingredients) > 0) {
            $recipe = (new AttachIngredientAction())
                ->forRecipe($recipe)
                ->attachIngredient($this->ingredients, $this->component_data)->attach();
        }

        return $recipe;
    }




}
