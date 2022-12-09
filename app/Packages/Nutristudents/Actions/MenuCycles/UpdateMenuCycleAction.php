<?php


namespace Bytelaunch\Nutristudents\Actions\MenuCycles;


use Bytelaunch\Nutristudents\Models\Grade;
use Bytelaunch\Nutristudents\Models\GradeRange;
use Bytelaunch\Nutristudents\Models\Offering;
use Bytelaunch\Nutristudents\Models\MenuCycle;

class UpdateMenuCycleAction
{
    private string $name;
    private string $ageRange;
    private string $daysId;
    private  $sourceId;

    private MenuCycle $menuCycle;

    public function setMenuCycle(MenuCycle $menuCycle): self
    {
        $this->menuCycle = $menuCycle;
        return $this;
    }

    public function setWeekNumber(int $week_number): self
    {
        $this->menuCycle->week_number = $week_number;
        return $this;
    }

    public function setName(string $name): self
    {
        $this->menuCycle->name = $name;
        return $this;
    }

    public function setMealType(string $mealType): self
    {
        $this->menuCycle->meal_type_id = $mealType;
        return $this;
    }

    public function setAgeRange(string $ageRange): self
    {               
        $this->menuCycle->age_grade_id = $ageRange;
        return $this;
    }

    public function setDays(string $daysId): self
    {               
        $this->menuCycle->days_id = $daysId;
        return $this;
    }

    public function setSourceId($sourceId): self
    {               
        $this->menuCycle->source_id = $sourceId;
        return $this;
    }

    public function setGuideline(string $guideline_id) : self
    {
        $this->menuCycle->guideline_id = $guideline_id;
        return $this;
    }

    public function update(): MenuCycle
    {        
                        
        $this->menuCycle->save();
        
        $menuCycle = $this->menuCycle;
        
        // $menuCycle = (new SyncGradeRangeAction())
        //     ->forMenuCycle($menuCycle)
        //     ->setGradeRange($this->gradeRange)
        //     ->attach();
        
        return $menuCycle;
    }


}
