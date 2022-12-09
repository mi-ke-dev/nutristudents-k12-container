<?php

namespace Bytelaunch\Nutristudents\Tests\Feature;

use Bytelaunch\Nutristudents\Actions\MenuCycleDayOptions\CreateOptionComponentAction;
use Bytelaunch\Nutristudents\Actions\MenuCycles\CreateMenuCycleAction;
use Bytelaunch\Nutristudents\Actions\MenuCycles\CreateMenuCycleForDayAction;
use Bytelaunch\Nutristudents\Actions\MenuCycleOptions\CreateOptionAction;
use Bytelaunch\Nutristudents\Actions\Recipes\CreateRecipeAction;
use Bytelaunch\Nutristudents\Models\MenuCycle;
use Bytelaunch\Nutristudents\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MenuCycleTest extends TestCase
{
    use RefreshDatabase;

    protected $recipes = [];
    protected function setUp(): void
    {
        parent::setUp();

        $this->recipes[] = (new CreateRecipeAction())
            ->setName('Hamburger')
            ->setCategory('Side')
            ->setRecipePortion(1)
            ->setServingSize(10)
            ->setCookingInstructions('Lorem ipsum...')
            ->create();

        $this->recipes[] = (new CreateRecipeAction())
            ->setName('Cheddar Sun Chips')
            ->setCategory('Side')
            ->setRecipePortion(1)
            ->setServingSize(1)
            ->setCookingInstructions('Lorem ipsum...')
            ->create();

        $this->recipes[] = (new CreateRecipeAction())
            ->setName('Shredded Cheddar Cheese')
            ->setCategory('Side')
            ->setRecipePortion(1)
            ->setServingSize(1)
            ->setCookingInstructions('Lorem ipsum...')
            ->create();

        $this->recipes[] = (new CreateRecipeAction())
            ->setName('Ketchup Packet')
            ->setCategory('Sauce')
            ->setRecipePortion(1)
            ->setServingSize(1)
            ->setCookingInstructions('Lorem ipsum...')
            ->create();

    }


    /**
     * @test
     */
    public function a_menu_cycle_can_be_created(): void
    {
        $this->assertNotNull($this->menuCycle1->id);
        $this->assertNotNull($this->menuCycle1->grade_range_id);

    }


    /**
     * @test
     */
    public function a_menu_cycle_day_can_be_created(): void
    {

        $this->menuCycleDayMON = (new CreateMenuCycleForDayAction)
            ->forMenuCycle($this->menuCycle1)
            ->setDayOfWeek('MON')
            ->create();


        $this->assertNotNull($this->menuCycleDayMON->id);

    }

    /**
     * @test
     */
    public function an_option_can_be_created_and_added_to_a_day(): void
    {

        $this->a_menu_cycle_day_can_be_created();

        $this->option1MON = (new CreateOptionAction)
            ->forMenuCycleDay($this->menuCycleDayMON)
            ->setImage('/some/image/path.png') // todo
            ->setSortOrder()
            ->create();

        $this->assertNotNull($this->option1MON->id);
    }
    /**
     * @test
     */
    public function an_option_component_can_be_created_and_added_to_an_option(): void
    {

        $this->an_option_can_be_created_and_added_to_a_day();

        $component1 = (new CreateOptionComponentAction)
            ->forMenuCycleDayOption($this->option1MON)
            ->attachRecipe($this->recipes[0])
            ->attachRecipe($this->recipes[1], ['LEG', 'OTH'], 'Revised cooking instructions', $smartSnack = false)
            ->attachRecipe($this->recipes[2])
            ->attachRecipe($this->recipes[3])
            ->setSortOrder(1)
            ->create();

        $mc = MenuCycle::with(['menuCycleDays.menuCycleDayOption.MenuCycleDayOptionComponents'])->get();

        $flat = $mc->flatten()->toArray();


        $this->assertNotNull($flat[0]['menu_cycle_days'][0]['menu_cycle_day_option']['id']);

        // todo: Validate this test. Ray looks good.!
        // todo: Are multiple options on a day stored separately? It looks like multiples might be added to the same option

    }


    /**
     * @test
     */
    public function an_options_sort_order_can_be_changed(): void
    {

    }

    /**
     * @test
     */
    public function an_option_can_be_moved_to_another_day_and_sort_order(): void
    {

    }

    /**
     * @test
     */
    public function a_recipe_can_be_added_to_an_option(): void
    {

    }

    /**
     * @test
     */
    public function a_recipe_can_be_sorted_within_an_option(): void
    {

    }

    /**
     * @test
     */
    public function an_option_can_be_copied(): void
    {

    }

    /**
     * @test
     */
    public function an_option_can_be_pasted(): void
    {

    }

    /**
     * @test
     */
    public function an_option_can_be_duplicated(): void
    {

    }

    /**
     * @test
     */
    public function an_option_can_be_deleted(): void
    {

    }


}
