<?php


namespace Bytelaunch\Nutristudents\Actions\WeekCycles;

use Bytelaunch\Nutristudents\Models\Grade;
use Bytelaunch\Nutristudents\Models\GradeRange;
use Bytelaunch\Nutristudents\Models\Meal;
use Bytelaunch\Nutristudents\Models\MenuCycle;
use Bytelaunch\Nutristudents\Models\WeekCycle;

class CreateWeekCycleAction
{

    private string $name;
    private Meal $meal;
    private GradeRange $gradeRange;
    private MenuCycle $menuCycle;

    public function setName(string $name) : self
    {
        $this->name = $name;
        return $this;
    }


    public function setMeal(Meal $meal) : self
    {
        $this->meal = $meal;
        return $this;
    }

    public function setGradeRange(GradeRange $gradeRange) : self
    {
        $this->gradeRange = $gradeRange;
        return $this;
    }


    public function setMenuCycle(MenuCycle $menuCycle) : self
    {
        $this->menuCycle = $menuCycle;
        return $this;
    }

    public function create() : WeekCycle
    {
        $weekCycle = WeekCycle::make([
            'name' => $this->name
        ]);

        $weekCycle = $weekCycle->meal()->associate($this->meal);
        $weekCycle = $weekCycle->grade_range()->associate($this->gradeRange);
        $weekCycle = $weekCycle->menu_cycle()->associate($this->menuCycle);
        $weekCycle->save();

        return $weekCycle;

    }


}
