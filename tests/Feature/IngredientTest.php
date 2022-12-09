<?php

namespace Bytelaunch\Nutristudents\Tests\Feature;

use Bytelaunch\Nutristudents\Actions\Ingredients\AttachProductAction;
use Bytelaunch\Nutristudents\Actions\Ingredients\CopyIngredientAction;
use Bytelaunch\Nutristudents\Models\Component;
use Bytelaunch\Nutristudents\Models\Ingredient;
use Bytelaunch\Nutristudents\Models\Product;
use Bytelaunch\Nutristudents\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IngredientTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }


    /**
     * @test
     */
    public function an_ingredient_can_be_created(): void
    {
       $this->assertNotNull($this->ingredient1->id);
    }

    /**
     * @test
     */
    public function a_preferred_product_must_match_components_as_ingredient(): void
    {

    }

    /**
     * @test
     */
    public function a_product_can_be_attached_to_an_ingredient(): void
    {
        $ingredient = (new AttachProductAction())
            ->forIngredient($this->ingredient1)
            ->attachProduct($this->product1)
            ->attach();

        $this->assertTrue($ingredient->products()->where('products.id', $this->product1->id)->exists());

    }

    /**
     * @test
     */
    public function an_ingredient_can_be_copied(): void
    {
        // attach a product,
        // to test deep copy
        $ingredient = (new AttachProductAction())
            ->forIngredient($this->ingredient1)
            ->attachProduct($this->product1)
            ->attach();

        // copy
        $newIngredient = (new CopyIngredientAction)
            ->sourceIngredient($this->ingredient1)
            ->copy();

        $this->assertNotNull($newIngredient->products[0]->pivot->ingredient_id);
        $this->assertNotEquals($ingredient->products[0]->pivot->ingredient_id, $newIngredient->products[0]->pivot->ingredient_id);

    }

}
