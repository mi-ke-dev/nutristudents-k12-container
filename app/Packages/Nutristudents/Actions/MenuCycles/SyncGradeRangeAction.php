<?php


namespace Bytelaunch\Nutristudents\Actions\MenuCycles;


use App\Models\User;
use Bytelaunch\Nutristudents\Models\Grade;
use Bytelaunch\Nutristudents\Models\GradeRange;
use Bytelaunch\Nutristudents\Models\MenuCycle;
use Bytelaunch\Nutristudents\Models\Site;

class SyncGradeRangeAction
{
    private MenuCycle $menuCycle;
    private GradeRange $gradeRange;

    public function forMenuCycle(MenuCycle $menuCycle): self
    {
        $this->menuCycle = $menuCycle;
        return $this;
    }

    public function setGradeRange(GradeRange $gradeRange): self
    {
        $this->gradeRange = $gradeRange;        
        return $this;
    }



    public function attach(): MenuCycle
    {
        $this->menuCycle->gradeRange()->associate($this->gradeRange)->save();

        return $this->menuCycle;
    }
}
