<?php


namespace Bytelaunch\Nutristudents\Actions\MenuCycles;


use Bytelaunch\Nutristudents\Models\MenuCycle;
use Bytelaunch\Nutristudents\Models\MenuCycleDay;

class UpdateMenuCycleForDayAction
{

    private MenuCycleDay $menuCycleDay;
    private string $day_of_week;

    public function setMenuCycleDay(MenuCycleDay $menuCycleDay): self
    {
        $this->menuCycleDay = $menuCycleDay;
        return $this;
    }

    public function setDayOfWeek(string $dayOfWeek): self
    {
        $this->menuCycleDay->day_of_week = $dayOfWeek;
        return $this;
    }

    public function update(): MenuCycleDay
    {
        $this->menuCycleDay->save();
        $menuCycleDayUpdate = $this->menuCycleDay;
        return $menuCycleDayUpdate;
    }


}
