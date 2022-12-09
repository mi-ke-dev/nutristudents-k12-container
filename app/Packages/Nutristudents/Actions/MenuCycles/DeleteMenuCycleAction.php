<?php


namespace Bytelaunch\Nutristudents\Actions\MenuCycles;

use Bytelaunch\Nutristudents\Models\MenuCycle;
use Bytelaunch\Nutristudents\Models\MenuCycleDay;
use Bytelaunch\Nutristudents\Models\MenuCycleDayOption;
use Bytelaunch\Nutristudents\Models\MenuCycleDayOptionComponent;

class DeleteMenuCycleAction
{

    private MenuCycle $menuCycle;

    public function sourceMenuCycle(MenuCycle $menuCycle) : self
    {        
        $this->menuCycle = $menuCycle;
        return $this;
    }

    public function deleteMC()
    {        
        $menuCycleDays = $this->menuCycle->menuCycleDays()->get(['id']);
        
        if(!empty($menuCycleDays)){
        foreach($menuCycleDays as $menuCycleDay){

            $menuCycleDayOptions = MenuCycleDayOption::where('menu_cycle_day_id',$menuCycleDay->id)->get(['id']);
            if(!empty($menuCycleDayOptions)){
            foreach($menuCycleDayOptions as $menuCycleDayOption){

                $menuCycleDayOptionComponentsDelete = MenuCycleDayOptionComponent::where('menu_cycle_day_option_id',$menuCycleDayOption->id)->delete();
                
            }

            $menuCycleDayOptionsDelete = MenuCycleDayOption::where('menu_cycle_day_id',$menuCycleDay->id)->delete();
            }
        }
        }

        $this->menuCycle->menuCycleDays()->delete();  
        $this->menuCycle->delete();      
    }

    public function deleteForce()
    {        
        $menuCycleDays = $this->menuCycle->menuCycleDays()->get(['id']);
        
        if(!empty($menuCycleDays)){
        foreach($menuCycleDays as $menuCycleDay){

            $menuCycleDayOptions = MenuCycleDayOption::where('menu_cycle_day_id',$menuCycleDay->id)->get(['id']);
            if(!empty($menuCycleDayOptions)){
            foreach($menuCycleDayOptions as $menuCycleDayOption){

                $menuCycleDayOptionComponentsDelete = MenuCycleDayOptionComponent::where('menu_cycle_day_option_id',$menuCycleDayOption->id)->delete();
                
            }

            $menuCycleDayOptionsDelete = MenuCycleDayOption::where('menu_cycle_day_id',$menuCycleDay->id)->delete();
            }
        }
        }

        $this->menuCycle->menuCycleDays()->delete();  
        $this->menuCycle->forceDelete();      
    }


}
