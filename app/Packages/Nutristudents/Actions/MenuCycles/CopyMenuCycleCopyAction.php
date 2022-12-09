<?php


namespace Bytelaunch\Nutristudents\Actions\MenuCycles;

use Bytelaunch\Nutristudents\Getters\Tenants\GetCurrentTenantGetter;
use Bytelaunch\Nutristudents\Models\Grade;
use Bytelaunch\Nutristudents\Models\GradeRange;
use Bytelaunch\Nutristudents\Models\Offering;
use Bytelaunch\Nutristudents\Models\MenuCycle;

class CopyMenuCycleCopyAction
{
    private MenuCycle $menuCycle;
    
    private ?int $user_id = null;
    private ?int $template = null; 
    private string $name = '';
    private  $week = '';

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

    public function setWeek($week)
    {
        $this->week_number = $week;
        return $this;
    }

    public function copy(): MenuCycle
    {
        $this->menuCycle = $this->menuCycle;
        $newMenuCycle = $this->menuCycle->replicate();
        $newMenuCycle->is_template = $this->is_template;
        $newMenuCycle->name = $this->mc_name;
        $newMenuCycle->week_number = $this->week_number;
        $newMenuCycle->tenant_id = (new GetCurrentTenantGetter)->first()->id;
        $newMenuCycle['source_id'] = null;
        $newMenuCycle->push();
        $newMenuCycle->save();
        
        return $newMenuCycle;
    }
}
