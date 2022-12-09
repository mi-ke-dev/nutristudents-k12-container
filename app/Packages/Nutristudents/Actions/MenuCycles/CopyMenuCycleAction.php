<?php


namespace Bytelaunch\Nutristudents\Actions\MenuCycles;

use Bytelaunch\Nutristudents\Getters\Tenants\GetCurrentTenantGetter;
use Bytelaunch\Nutristudents\Models\Calendar;
use Bytelaunch\Nutristudents\Models\Grade;
use Bytelaunch\Nutristudents\Models\GradeRange;
use Bytelaunch\Nutristudents\Models\Offering;
use Bytelaunch\Nutristudents\Models\MenuCycle;

class CopyMenuCycleAction
{
    private MenuCycle $menuCycle;
    
    private ?int $user_id = null;
    private ?int $template = null; 
    private string $name = '';
    private Calendar $calendar;

    public function forCalender(Calendar $calendar) : self
    {
        $this->calendar = $calendar;
        return $this;
    }

    public function forMenCycle(MenuCycle $menuCycle) : self
    {
        $this->menuCycle = $menuCycle;
        return $this;
    }

    public function setTemplate($template){
        if($template === 0){
            $this->is_template = 0; 
        }else{
            $this->is_template = 1;
        }
        return $this;
    }

    public function setName(string $name) : self
    {
        $this->mc_name = $name;
        return $this;
    }

    public function copy(): MenuCycle
    {
        $this->menuCycle->load(['menuCycleDays', 'menuCycleDays.menuCycleDayOptions', 'menuCycleDays.menuCycleDayOptions.menuCycleDayOptionComponents']);
        $newMenuCycle = $this->menuCycle->replicate();
        $newMenuCycle->is_template = $this->is_template;
        $newMenuCycle->name = $this->mc_name;
        $newMenuCycle['source_id'] = $this->menuCycle->id;
        $newMenuCycle['group_source_id'] = $this->menuCycle->id;
        $newMenuCycle->tenant_id = (new GetCurrentTenantGetter)->first()->id;
        if(isset($this->calendar)){
            $newMenuCycle->guideline_id = $this->calendar->guide_line_id;
        }
        $newMenuCycle->push();
        
        foreach ($this->menuCycle->getRelations() as $relation => $entries){
            foreach($entries as $entry){
                $e = $entry->replicate();
                $e->group_source_id = $entry['id'];
                if ($e->push()){
                    $newMenuCycle->{$relation}()->save($e);
                    foreach ($entry->getRelations() as $relation_c => $entries_c){
                        foreach($entries_c as $entry_c){
                            $ec = $entry_c->replicate();
                            $ec->group_source_id = $entry_c['id'];
                            if ($ec->push()){
                                $e->{$relation_c}()->save($ec);
                                foreach ($entry_c->getRelations() as $relation_c1 => $entries_c1){
                                    foreach($entries_c1 as $entry_c1){
                                        $ec1 = $entry_c1->replicate();
                                        $ec1->source_id = $entry_c1['id'];
                                        $ec1->group_source_id = $entry_c1['id'];
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
        return $newMenuCycle;
    }


}
