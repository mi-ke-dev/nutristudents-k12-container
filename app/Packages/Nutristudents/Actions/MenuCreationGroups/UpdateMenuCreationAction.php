<?php


namespace Bytelaunch\Nutristudents\Actions\MenuCreationGroups;
use Bytelaunch\Nutristudents\Models\MenuCreationGroup;

class UpdateMenuCreationAction
{
    private string $name;
    private string $ageRange;
    private string $daysId;
    private  $sourceId;
    private $offerings = [];

    private MenuCreationGroup $group;

    public function setMenuCycle(MenuCreationGroup $group): self
    {
        $this->group = $group;
        return $this;
    }

    public function setName(string $name): self
    {
        $this->group->name = $name;
        return $this;
    }

    public function setMealType(string $mealType): self
    {
        $this->group->meal_type_id = $mealType;
        return $this;
    }

    public function setAgeRange(string $ageRange): self
    {               
        $this->group->age_grade_offering_id = $ageRange;
        return $this;
    }

    public function setDays(string $daysId): self
    {               
        $this->group->day_id = $daysId;
        return $this;
    }


    public function setGuideline(string $guideline_id) : self
    {
        $this->group->guideline_id = $guideline_id;
        return $this;
    }

    public function setOffering($offerings){
        $this->offerings = $offerings;            
        return $this;
    }

    public function update(): MenuCreationGroup
    {                              
        $this->group->save();
        $group = $this->group; 
        
    
        $offring = (new SyncOfferingAction())
            ->forMenuCreationGroup($group)
            ->attachOffering($this->offerings)->attach();
        
        return $group;
    }
}
