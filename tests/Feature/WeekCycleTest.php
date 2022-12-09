<?php

namespace Bytelaunch\Nutristudents\Tests\Feature;

use Bytelaunch\Nutristudents\Actions\WeekCycles\CreateWeekCycleAction;
use Bytelaunch\Nutristudents\Models\MenuCycle;
use Bytelaunch\Nutristudents\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WeekCycleTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        parent::createSomeMenuCycles();

        $menuCycle = MenuCycle::with(['menuCycleDays.menuCycleDayOption.MenuCycleDayOptionComponents'])->where('name', 'Week 1')->first()->id;
        $menuCycle = MenuCycle::findOrFail($menuCycle);


        $this->weekCycle = (new CreateWeekCycleAction)
            ->setName("Week Cycle 1")
            ->setMeal($this->mealLunch)
            ->setGradeRange($this->gradeRange1)
            ->setMenuCycle($menuCycle)
            ->create();
    }


    /**
     * @test
     */
    public function a_week_cycle_can_be_created(): void
    {

        $this->assertNotNull($this->weekCycle->id);

    }

    /**
     * @test
     */
    public function a_menu_cycle_can_be_copied(): void
    {

    }

    /**
     * @test
     */
    public function a_menu_cycle_can_be_pasted(): void
    {

    }

    /**
     * @test
     */
    public function a_menu_cycle_can_be_reordered(): void
    {

    }


}
