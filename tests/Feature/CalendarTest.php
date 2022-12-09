<?php

namespace Bytelaunch\Nutristudents\Tests\Feature;

use Bytelaunch\Nutristudents\Actions\Calendar\CreateCalendarAction;
use Bytelaunch\Nutristudents\Actions\WeekCycles\CreateWeekCycleAction;
use Bytelaunch\Nutristudents\Actions\WeekCycles\ImportWeekCycleAction;
use Bytelaunch\Nutristudents\Exceptions\CouldNotImportToCalendar;
use Bytelaunch\Nutristudents\Models\MenuCycle;
use Bytelaunch\Nutristudents\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CalendarTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->calender = (new CreateCalendarAction)
            ->setSite($this->site1)
            ->setMeal($this->mealLunch)
            ->setGradeRange($this->gradeRange1)
            ->create();

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
    public function a_calendar_can_be_created(): void
    {
//    $this->assertNotNull($this->calendar->id);

    }


    /**
     * @test
     */
    public function a_week_cycle_can_be_imported(): void
    {
//
//        parent::createSomeMenuCycles();
//
//        $calendar = (new ImportWeekCycleAction)
//            ->forCalendar($this->calender)
//            ->useWeekCycle($this->weekCycle)
//            ->startingOnMondayDate('2021-05-03')
//            ->import();

        // Must be a Monday

    }

    /**
     * @test
     */
    public function an_imported_week_cycle_must_be_on_a_monday(): void
    {
        $this->expectException(CouldNotImportToCalendar::class );
        parent::createSomeMenuCycles();

        $calendar = (new ImportWeekCycleAction)
            ->forCalendar($this->calender)
            ->useWeekCycle($this->weekCycle)
            ->startingOnMondayDate('2020-05-01')
            ->import();

        // Must be a Monday

    }


    /**
     * @test
     */
    public function a_week_cycle_can_be_duplicated(): void
    {

    }

    /**
     * @test
     */
    public function a_week_can_be_copied(): void
    {

    }

    /**
     * @test
     */
    public function a_week_can_be_pasted(): void
    {

    }


    /**
     * @test
     */
    public function a_day_can_be_copied(): void
    {

    }

    /**
     * @test
     */
    public function a_day_can_be_pasted(): void
    {

    }


    /**
     * @test
     */
    public function a_day_can_be_added_to_order(): void
    {

    }

    /**
     * @test
     */
    public function a_day_can_be_removed_from_order(): void
    {

    }


    /**
     * @test
     */
    public function a_week_can_be_added_to_order(): void
    {

    }


}
