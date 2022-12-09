<?php

namespace Bytelaunch\Nutristudents\Tests\Feature;

use Bytelaunch\Nutristudents\Actions\Ingredients\CreateIngredientAction;
use Bytelaunch\Nutristudents\Actions\Recipes\CopyRecipeAction;
use Bytelaunch\Nutristudents\Actions\Recipes\CreateRecipeAction;
use Bytelaunch\Nutristudents\Getters\Recipes\RecipeHasPhoto;
use Bytelaunch\Nutristudents\Models\Component;
use Bytelaunch\Nutristudents\Models\Recipe;
use Bytelaunch\Nutristudents\Models\UnitOfMeasurement;
use Bytelaunch\Nutristudents\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RecipeTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->ingBun = (new CreateIngredientAction())
            ->setName("Bun")
            ->setComponent(Component::na())
            ->create();
        $this->ingKetchup = (new CreateIngredientAction())
            ->setName("Ketchup")
            ->setComponent(Component::na())
            ->create();
        $this->ingMustard = (new CreateIngredientAction())
            ->setName("Mustard")
            ->setComponent(Component::na())
            ->create();
        $this->ingTomato = (new CreateIngredientAction())
            ->setName("Tomatoe")
            ->setComponent(Component::na())
            ->create();
        $this->ingLettuce = (new CreateIngredientAction())
            ->setName("Lettuce")
            ->setComponent(Component::na())
            ->create();
        $this->ingOnion = (new CreateIngredientAction())
            ->setName("Onion")
            ->setComponent(Component::na())
            ->create();
        $this->ingHamburgerPatty = (new CreateIngredientAction())
            ->setName("Hamburger Patty")
            ->setComponent(Component::na())
            ->create();
        $this->ingPickleSlice = (new CreateIngredientAction())
            ->setName("Pickle Slice}")
            ->setComponent(Component::na())
            ->create();

    }


    /**
     * @test
     */
    public function a_recipe_can_be_created(): void
    {

        $recipe = (new CreateRecipeAction())
            ->setName('Hamburger')
            ->setCategory('Entree')
            ->setRecipePortion(10)
            ->setServingSize(1)
            ->setCookingInstructions('Lorem ipsum...')
            ->create();

        $this->assertNotNull($recipe->id);

    }

    /**
     * @test
     */
    public function an_ingredient_can_be_attached_to_a_recipe(): void
    {
        $recipe = (new CreateRecipeAction())
            ->setName('Hamburger')
            ->setCategory('Entree')
            ->setRecipePortion(10)
            ->setServingSize(1)
            ->setCookingInstructions('Lorem ipsum...')
            ->addIngredient($this->ingBun, 1, UnitOfMeasurement::piece(), ['WGR' => .5])
            ->addIngredient($this->ingKetchup, 1, UnitOfMeasurement::teaspoon(), [])
            ->addIngredient($this->ingMustard, 1, UnitOfMeasurement::teaspoon(), [])
            ->addIngredient($this->ingTomato, 1, UnitOfMeasurement::piece(), [])
            ->addIngredient($this->ingLettuce, 1, UnitOfMeasurement::piece(), [])
            ->addIngredient($this->ingOnion, 1, UnitOfMeasurement::piece(), [])
            ->addIngredient($this->ingHamburgerPatty, 1, UnitOfMeasurement::piece(), ['MMA' => 2])
            ->addIngredient($this->ingPickleSlice, 2, UnitOfMeasurement::piece(), ['WGR' => .5])
            ->create();

        $this->assertNotNull($recipe->id);
        $this->assertCount(8, $recipe->ingredients);

    }

    /**
     * @test
     */
    public function a_recipe_can_be_copied(): void
    {
        $recipe = (new CreateRecipeAction())
            ->setName('Hamburger')
            ->setCategory('Entree')
            ->setRecipePortion(10)
            ->setServingSize(1)
            ->setCookingInstructions('Lorem ipsum...')
            ->addIngredient($this->ingBun, 1, UnitOfMeasurement::piece(), ['WGR' => .5])
            ->addIngredient($this->ingKetchup, 1, UnitOfMeasurement::teaspoon(), [])
            ->addIngredient($this->ingMustard, 1, UnitOfMeasurement::teaspoon(), [])
            ->addIngredient($this->ingTomato, 1, UnitOfMeasurement::piece(), [])
            ->addIngredient($this->ingLettuce, 1, UnitOfMeasurement::piece(), [])
            ->addIngredient($this->ingOnion, 1, UnitOfMeasurement::piece(), [])
            ->addIngredient($this->ingHamburgerPatty, 1, UnitOfMeasurement::piece(), ['MMA' => 2])
            ->addIngredient($this->ingPickleSlice, 2, UnitOfMeasurement::piece(), ['WGR' => .5])
            ->create();

        // copy
        $newRecipe = (new CopyRecipeAction())
            ->sourceRecipe($recipe)
            ->copy();

        $this->assertNotNull($newRecipe->ingredients[0]->pivot->recipe_id);
        $this->assertNotEquals($newRecipe->ingredients[0]->pivot->recipe_id, $recipe->ingredients[0]->pivot->recipe_id);


    }


    /**
     * @test
     */
    public function a_recipe_has_a_photo(): void
    {
        $recipe = (new CreateRecipeAction())
            ->setName('Hamburger')
            ->setCategory('Entree')
            ->setRecipePortion(10)
            ->setServingSize(1)
            ->setCookingInstructions('Lorem ipsum...')
            ->create();
        $recipe->photo_store_path = "image.png";
        $recipe->save();

        $hasphoto = (new RecipeHasPhoto)
        ->forRecipe($recipe)
        ->get();

        $this->assertTrue($hasphoto);

    }

}
