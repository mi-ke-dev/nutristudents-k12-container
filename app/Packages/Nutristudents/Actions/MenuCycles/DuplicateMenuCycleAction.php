<?php


namespace Bytelaunch\Nutristudents\Actions\MenuCycles;

use Bytelaunch\Nutristudents\Getters\Tenants\GetCurrentTenantGetter;
use Bytelaunch\Nutristudents\Models\MenuCycle;
use Bytelaunch\Nutristudents\Models\MenuCycleDay;
use Bytelaunch\Nutristudents\Models\MenuCycleDayOption;
use Bytelaunch\Nutristudents\Models\MenuCycleDayOptionComponent;

class DuplicateMenuCycleAction
{

    private MenuCycle $menuCycle;

    public function sourceMenuCycle(MenuCycle $menuCycle) : self
    {        
        $this->menuCycle = $menuCycle;
        return $this;
    }

    public function duplicate()
    {        
        $menuCycle = MenuCycle::with(['menuCycleDays.menuCycleDayOptions.MenuCycleDayOptionComponents'])->find($this->menuCycle->id);
        //dd($menuCycle);
        $newMenuCycle = $menuCycle->replicate();
        $newMenuCycle->tenant_id = (new GetCurrentTenantGetter)->first()->id;
        $newMenuCycle->push();

        $mcDaysObject = $menuCycle->getRelations();   
        //dd($mcDaysObject);     
            
            if(!empty($mcDaysObject)){
            foreach ($mcDaysObject as $mcDays) {
                
                if(!empty($mcDays)){
                foreach($mcDays as $mcDay){
                    
                    $mcDay_duplicate = $mcDay->replicate();
                    $mcDay_duplicate->menu_cycle_id = $newMenuCycle->id;
                    $mcDay_duplicate->push();
                    
                    $mcDayOptionObject = $mcDay->getRelations();
                    
                    if(!empty($mcDayOptionObject)){
                    foreach($mcDayOptionObject as $mcDayOptionMain) {
                    foreach($mcDayOptionMain as $mcDayOption) {                        
                        $mcDayOption_duplicate = $mcDayOption->replicate();
                        $mcDayOption_duplicate->menu_cycle_day_id = $mcDay_duplicate->id;
                        $mcDayOption_duplicate->push();

                        $mcDayOptionComponentObject = $mcDayOption->getRelations();
                        //dd($mcDayOptionComponentObject);
                        
                        if(!empty($mcDayOptionComponentObject)){
                        foreach($mcDayOptionComponentObject as $mcDayOptComponents){
                        //dd($mcDayOptComponent);
                            foreach($mcDayOptComponents as $mcDayOptComponent){
                                $mcDayComponent_duplicate = $mcDayOptComponent->replicate();
                                $mcDayComponent_duplicate->menu_cycle_day_option_id = $mcDayOption_duplicate->id;
                                $mcDayComponent_duplicate->push(); 
                            }                       
                        }
                        }

                    }

                    }
                    }
                }
                }
            }
            }        

        $newMenuCycle->name .= ' (Copy)'; 

        $newMenuCycle->save();

        return $newMenuCycle;
    }


}
