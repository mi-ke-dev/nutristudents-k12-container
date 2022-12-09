<?php


namespace Bytelaunch\Nutristudents\Actions\MenuCycleDayOptions;


use Bytelaunch\Nutristudents\Models\MenuCycleDay;
use Bytelaunch\Nutristudents\Models\MenuCycleDayOption;

class DeleteMenuCycleDayOptionAction
{

    private MenuCycleDayOption $menuCycleDayOption;

    public function sourceMenuCycleOption(MenuCycleDayOption $menuCycleDayOption) : self
    {        
        $this->menuCycleDayOption = $menuCycleDayOption;
        return $this;
    }

    public function delete()
    {        
        $this->menuCycleDayOption->menuCycleDayOptionComponents()->delete();  
        $this->menuCycleDayOption->delete();      
    }


}
