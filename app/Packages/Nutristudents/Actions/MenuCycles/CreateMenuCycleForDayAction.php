<?php


namespace Bytelaunch\Nutristudents\Actions\MenuCycles;


use Bytelaunch\Nutristudents\Models\MenuCycle;
use Bytelaunch\Nutristudents\Models\MenuCycleDay;

class CreateMenuCycleForDayAction
{

    private MenuCycle $menuCycle;
    private string $dayOfWeek;

    public function forMenuCycle(MenuCycle $menuCycle): self
    {
        $this->menuCycle = $menuCycle;
        return $this;
    }

    public function setDayOfWeek(string $dayOfWeek): self
    {
        $this->dayOfWeek = $dayOfWeek;
        return $this;
    }

    public function create(): MenuCycleDay
    {
        $menuCycleDay = MenuCycleDay::make([
            'day_of_week' => $this->dayOfWeek
        ]);

        $menuCycleDay->menuCycle()->associate($this->menuCycle)->save();

        return $menuCycleDay;
    }


}
