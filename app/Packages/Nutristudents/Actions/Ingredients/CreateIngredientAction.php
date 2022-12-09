<?php


namespace Bytelaunch\Nutristudents\Actions\Ingredients;


use App\Models\User;
use Bytelaunch\Nutristudents\Getters\Tenants\GetCurrentTenantGetter;
use Bytelaunch\Nutristudents\Models\Component;
use Bytelaunch\Nutristudents\Models\Ingredient;
use Bytelaunch\Nutristudents\Models\Site;

class CreateIngredientAction
{
    private string $name;
    private Component $component;
    private ?string $prefer_product_id = null;

    public function setName(string $name): self
    {
        $this->name = $name;
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
        $this->prefer_product_id = $product_id;
        return $this;
    }


    public function create(): Ingredient
    {
        $tenant_id = (new GetCurrentTenantGetter)->first()->id;
        $ingredient = Ingredient::create([
            'tenant_id' => $tenant_id,  
            'name' => $this->name,
            'prefer_product_id' => $this->prefer_product_id
        ]);
        
        if (isset($this->component)) {
            $ingredient = (new AttachComponentAction)
                ->forIngredient($ingredient)
                ->attachComponent($this->component)
                ->attach();
        }

        return $ingredient;
    }
}
