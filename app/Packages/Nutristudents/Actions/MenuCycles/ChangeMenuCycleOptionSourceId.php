<?php


namespace Bytelaunch\Nutristudents\Actions\MenuCycles;

use Bytelaunch\Nutristudents\Models\Calendar;
use Bytelaunch\Nutristudents\Models\Grade;
use Bytelaunch\Nutristudents\Models\GradeRange;
use Bytelaunch\Nutristudents\Models\Offering;
use Bytelaunch\Nutristudents\Models\MenuCycle;

class ChangeMenuCycleOptionSourceId
{
    private MenuCycle $menuCycle;
    
    private  $sourceId;

    public function forMenCycle(MenuCycle $menuCycle) : self
    {
        $this->menuCycle = $menuCycle;
        return $this;
    }

    public function setSourceId($sourceId = null): self
    {               
        $this->sourceId = $sourceId;
        return $this;
    }

    

    public function change(): MenuCycle
    {
        $this->menuCycle->load(['menuCycleDays', 'menuCycleDays.menuCycleDayOptions', 'menuCycleDays.menuCycleDayOptions.menuCycleDayOptionComponents']);
        if($this->menuCycle->menuCycleDays){
            foreach($this->menuCycle->menuCycleDays as $menuCycleDays){
                if($menuCycleDays->menuCycleDayOptions){
                    foreach($menuCycleDays->menuCycleDayOptions as $menuCycleDayOptions){
                        if($menuCycleDayOptions->menuCycleDayOptionComponents){
                            foreach($menuCycleDayOptions->menuCycleDayOptionComponents as $menuCycleDayOptionComponents){
                                $menuCycleDayOptionComponents->source_id = $this->sourceId;
                                $menuCycleDayOptionComponents->group_source_id = $this->sourceId;
                                $menuCycleDayOptionComponents->save();
                            }
                        }
                    }
                }
            }
        }
        return $this->menuCycle;
    }


}
