<?php

namespace Bytelaunch\Nutristudents\Tests\Feature;

use Bytelaunch\Nutristudents\Actions\Products\AssociateDistributorAction;
use Bytelaunch\Nutristudents\Actions\Products\AttachAllergenAction;
use Bytelaunch\Nutristudents\Actions\Products\AttachComponentAction;
use Bytelaunch\Nutristudents\Actions\Products\AttachTagAction;
use Bytelaunch\Nutristudents\Actions\Products\CopyProductAction;
use Bytelaunch\Nutristudents\Actions\Products\CreateProductAction;
use Bytelaunch\Nutristudents\Getters\Products\checkAllergensGetter;
use Bytelaunch\Nutristudents\Getters\Products\GetProductTags;
use Bytelaunch\Nutristudents\Models\Allergen;
use Bytelaunch\Nutristudents\Models\Component;
use Bytelaunch\Nutristudents\Models\Product;
use Bytelaunch\Nutristudents\Models\Tag;
use Bytelaunch\Nutristudents\Models\UnitOfMeasurement;
use Bytelaunch\Nutristudents\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

    }


    /**
     * @test
     */
    public function a_simple_product_can_be_created(): void
    {

        $product = (new CreateProductAction)
            ->setName("Hamburger")
            ->setDistrubutor($this->distributor1)
            ->setManufacturer("Tyson")
            ->setManufacturerNumber("12341234")
            ->create();

        $this->assertEquals('Hamburger', $product->name);
    }

    /**
     * @test
     */
    public function a_detailed_product_can_be_created(): void
    {

        $product = (new CreateProductAction)
            ->setName("Hamburger")
            ->setDistrubutor($this->distributor1)
            ->setManufacturer("Tyson")
            ->setManufacturerNumber("12341234")
            ->attachComponent(Component::meat(), Component::dairy(), true)
            ->attachComponent(Component::veg(), Component::vegLeg())
            ->attachTag("Hamburger")
            ->attachTag("Tyson")
            ->attachTag("Meat")
            ->attachTag("Kid Favorite")
            ->setCaseWeight(100.5, UnitOfMeasurement::ounce())
            ->setSubCaseWeight(9.5, UnitOfMeasurement::cup())
            ->setCaseVolume(9.5, UnitOfMeasurement::cup())
            ->setSubCaseVolume(9.5, UnitOfMeasurement::cup())
            ->setCaseQuantity(20)
            ->setSubCaseQuantity(100)
            ->setServingMeasurementWeight(10, UnitOfMeasurement::gram())
            ->setServingMeasurementVolume(10, UnitOfMeasurement::cup())
            ->setServingMeasurementUnit(10, UnitOfMeasurement::piece())
            ->setUsdaComponentMeatServing(1.5)
            ->setUsdaComponentGrainServing(0.5)
            ->setUsdaComponentFruitServing(0.5)
            ->setUsdaComponentVegServing(0.0)
            ->setUsdaComponentVegLegServing(1.0)
            ->setUsdaComponentVegRedServing(0.0)
            ->setUsdaComponentVegGrnServing(0.0)
            ->setUsdaComponentVegStarServing(0.0)
            ->setUsdaComponentVegOthrServing(0.0)
            ->setNutritionFactWeight(1, UnitOfMeasurement::pound())
            ->setNutritionFactVolume(1, UnitOfMeasurement::cup())
            ->setNutritionFactUnit(1, UnitOfMeasurement::na())
            ->setNutritionFactCalories(200.)
            ->setNutritionFactCalFat(200.)
            ->setNutritionFactTotalFat(200.)
            ->setNutritionFactSatFat(200.)
            ->setNutritionFactTransFat(200.)
            ->setNutritionFactPolySatFat(200.)
            ->setNutritionFactMonoSatFat(200.)
            ->setNutritionFactCholesterol(200.)
            ->setNutritionFactSodium(200.)
            ->setNutritionFactPotassium(200.)
            ->setNutritionFactCarbs(200.)
            ->setNutritionFactFiber(200.)
            ->setNutritionFactSugar(200.)
            ->setNutritionFactProtein(200.)
            ->setNutritionFactVitaminA(200.)
            ->setNutritionFactVitaminB6(200.)
            ->setNutritionFactVitaminB12(200.)
            ->setNutritionFactVitaminC(200.)
            ->setNutritionFactVitaminD(200.)
            ->setNutritionFactVitaminE(200.)
            ->setNutritionFactCalcium(200.)
            ->setNutritionFactIron(200.)
            ->setNutritionFactMagnesium(200.)
            ->setNutritionFactCoblamin(200.)
            ->setNutritionFactThiamin(200.)
            ->setNutritionFactRiboflavin(200.)
            ->setNutritionFactNiacin(200.)
            ->setNutritionFactZinc(200.)
            ->setNutritionFactWater(200.)
            ->setNutritionFactAsh(200.)
            ->attachAllergen(Allergen::egg())
            ->attachAllergen(Allergen::meat())
            ->attachAllergen(Allergen::wheat())
            ->create();

        $product = Product::with('allergens')
            ->with('components')
            ->with('tags')
            ->find($product->id);

        $this->assertEquals('Hamburger', $product->name);
    }

    /**
     * @test
     */
    public function an_allergen_can_be_attached_to_a_new_product(): void
    {
        $product = (new CreateProductAction)
            ->setName("Hamburger")
            ->attachAllergen(Allergen::egg())
            ->attachAllergen(Allergen::meat())
            ->attachAllergen(Allergen::wheat())
            ->create();

        $this->assertTrue($product->allergens()->where('allergens.id', Allergen::egg()->id)->exists());

    }

    /**
     * @test
     */
    public function a_component_can_be_attached_to_a_new_product(): void
    {
        $product = (new CreateProductAction)
            ->setName("Hamburger")
            ->attachComponent(Component::meat(), Component::dairy(), true)
            ->attachComponent(Component::veg(), Component::vegLeg())
            ->create();

        $this->assertTrue($product->components()->where('components.id', Component::meat()->id)->exists());

    }


    /**
     * @test
     */
    public function a_new_tag_can_be_attached_to_a_new_product(): void
    {

        $product = (new CreateProductAction)
            ->setName("Hamburger")
            ->attachTag("Hamburger")
            ->attachTag("Tyson")
            ->attachTag("Meat")
            ->attachTag("Kid Favorite")
            ->create();

        $this->assertTrue($product->tags()->where('tags.id', Tag::where('name', 'Kid Favorite')->firstOrFail()->id)->exists());

    }


    /**
     * @test
     */
    public function an_existing_tag_can_be_attached_to_a_new_product(): void
    {

        $tag = Tag::create(['name' => 'Kid Favorite']);

        $product = (new CreateProductAction)
            ->setName("Hamburger")
            ->attachTag("Hamburger")
            ->attachTag("Tyson")
            ->attachTag("Meat")
            ->attachTag("Kid Favorite") // This tag already exists above

            ->create();

        $this->assertTrue($product->tags()->where('tags.id', $tag->id)->exists());

    }

    /**
     * @test
     */
    public function an_allergen_can_be_attached_to_an_existing_product(): void
    {
        $product = (new AttachAllergenAction())
            ->forProduct($this->product1)
            ->attachAllergen(Allergen::egg())
            ->attachAllergen(Allergen::meat())
            ->attachAllergen(Allergen::wheat())
            ->attach();

        $this->assertTrue($product->allergens()->where('allergens.id', Allergen::egg()->id)->exists());

    }

    /**
     * @test
     */
    public function a_component_can_be_attached_to_an_existing_product(): void
    {
        $product = (new AttachComponentAction())
            ->forProduct($this->product1)
            ->attachComponent(Component::meat(), Component::dairy(), true)
            ->attachComponent(Component::veg(), Component::vegLeg())
            ->attach();

        $this->assertTrue($product->components()->where('components.id', Component::meat()->id)->exists());

    }

    /**
     * @test
     */
    public function a_tag_can_be_attached_to_an_existing_product(): void
    {
        $product = (new AttachTagAction())
            ->forProduct($this->product1)
            ->attachTag("Hamburger")
            ->attachTag("Tyson")
            ->attachTag("Meat")
            ->attachTag("Kid Favorite")
            ->attach();

        $this->assertTrue($product->tags()->where('tags.id', Tag::where('name', 'Kid Favorite')->firstOrFail()->id)->exists());

    }

    /**
     * @test
     */
    public function a_distributor_can_be_added_to_an_existing_product(): void
    {
        $product = (new AssociateDistributorAction())
            ->forProduct($this->product1)
            ->setDistributor($this->distributor1)
            ->associate();

        $this->assertEquals($product->distributor_id, $this->distributor1->id);

    }

    /**
     * @test
     */
    public function a_list_of_relevant_subcomponents_can_be_suggested_for_a_component(): void
    {
        // todo
    }


    /**
     * @test
     */
    public function products_can_be_filtered_by_component(): void
    {
        $product = (new CreateProductAction)
            ->setName("Chicken Burger")
            ->attachComponent(Component::meat(), Component::dairy(), true)
            ->attachComponent(Component::veg(), Component::vegLeg())
            ->create();

        $products = Product::byComponent(Component::veg())->get();

        $this->assertGreaterThan(0, $products->count());
    }

    /**
     * @test
     */
    public function products_can_be_filtered_by_component_and_sub_component(): void
    {

    }


    /**
     * @test
     */
    public function a_list_of_tags_can_be_retrieved_from_a_product(): void
    {
        $product = (new AttachTagAction())
            ->forProduct($this->product1)
            ->attachTag("Hamburger")
            ->attachTag("Tyson")
            ->attachTag("Meat")
            ->attachTag("Kid Favorite")
            ->attach();

        $tags = (new GetProductTags())
            ->forProduct($this->product1)
            ->get();

        $this->assertCount(4, $tags);


        ray($tags);

    }


    /**
     * @test
     */
    public function determine_if_a_product_contains_known_allergens(): void
    {
        $product = (new AttachAllergenAction())
            ->forProduct($this->product1)
            ->attachAllergen(Allergen::egg())
            ->attachAllergen(Allergen::meat())
            ->attachAllergen(Allergen::wheat())
            ->attach();

        $allergens = (new checkAllergensGetter)
        ->forProduct($product)
        ->get();

        $this->assertNotEquals(3, count($allergens));
    }


    /**
     * @test
     */
    public function a_product_can_be_copied(): void
    {

        $new_product = (new CopyProductAction())
                    ->sourceProduct($this->product1)
                    ->copy();

        $this->assertNotNull($new_product->id);
    }


}
