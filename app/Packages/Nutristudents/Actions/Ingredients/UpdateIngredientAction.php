<?php


namespace Bytelaunch\Nutristudents\Actions\Ingredients;


use App\Models\User;
use Bytelaunch\Nutristudents\Models\Component;
use Bytelaunch\Nutristudents\Models\Ingredient;
use Bytelaunch\Nutristudents\Models\Site;

class UpdateIngredientAction
{
    private string $name;
    private Component $component;
    private string $prefer_product_id;

    private Ingredient $ingredient;

    public function setIngredient(Ingredient $ingredient): self
    {
        $this->ingredient = $ingredient;
        return $this;
    }

    public function setName(string $name): self
    {
        $this->ingredient->name = $name;
        return $this;
    }

    public function setComponent(Component $component): self
    {
        $this->component = $component;
        return $this;
    }
    
    //setup_custom method for saving prefer product id
    public function setPreferProduct(string $product_id): self
    {
        $this->ingredient->prefer_product_id = $product_id;
        return $this;
    }


    public function update(): Ingredient
    {
        // $ingredient = Ingredient::create([
        //     'name' => $this->name,
        //     'prefer_product_id' => $this->prefer_product_id
        // ]);

        $this->ingredient->save();

        $ingredient = $this->ingredient;        

        return $ingredient;
    }
}
