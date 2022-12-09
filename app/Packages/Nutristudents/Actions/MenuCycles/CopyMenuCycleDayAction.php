<?php


namespace Bytelaunch\Nutristudents\Actions\MenuCycles;


use Bytelaunch\Nutristudents\Models\Grade;
use Bytelaunch\Nutristudents\Models\GradeRange;
use Bytelaunch\Nutristudents\Models\Offering;
use Bytelaunch\Nutristudents\Models\MenuCycle;
use Bytelaunch\Nutristudents\Models\MenuCycleDay;

class CopyMenuCycleDayAction
{
    private MenuCycleDay $menuCycleDay;
    
    private ?int $user_id = null;
    private $menuCycleId; 
    private string $name = '';

    public function forMenCycleDay(MenuCycleDay $menuCycleDay) : self
    {
        $this->menuCycleDay = $menuCycleDay;
        return $this;
    }

    public function setMenuCycleId($menuCycleId){
        $this->menu_cycle_id = $menuCycleId;
        return $this;
    }

    public function setDayOfWeek(string $week) : self
    {
        $this->day_of_week = $week;
        return $this;
    }

    public function copy(): MenuCycleDay
    {
        $this->menuCycleDay->load(['menuCycleDayOptions.menuCycleDayOptionComponents']); 
        $newMenuCycleDay = $this->menuCycleDay->replicate();
        $newMenuCycleDay->day_of_week = $this->day_of_week;
        $newMenuCycleDay->menu_cycle_id = $this->menu_cycle_id;
        $newMenuCycleDay->push();
        
        foreach ($this->menuCycleDay->getRelations() as $relation => $entries){
            
            foreach($entries as $entry){
                $e = $entry->replicate();
                if ($e->push()){
                    $newMenuCycleDay->{$relation}()->save($e);
                    foreach ($entry->getRelations() as $relation_c => $entries_c){
                        foreach($entries_c as $entry_c){
                            $ec = $entry_c->replicate();
                            if ($ec->push()){
                                $e->{$relation_c}()->save($ec);
                                foreach ($entry_c->getRelations() as $relation_c1 => $entries_c1){
                                    foreach($entries_c1 as $entry_c1){
                                        $ec1 = $entry_c1->replicate();
                                        if ($ec1->push()){
                                            $ec->{$relation_c1}()->save($ec1);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
         return $newMenuCycleDay;
    }


}
