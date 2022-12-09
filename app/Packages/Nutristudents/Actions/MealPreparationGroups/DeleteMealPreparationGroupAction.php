<?php


namespace Bytelaunch\Nutristudents\Actions\MealPreparationGroups;
use Bytelaunch\Nutristudents\Models\MealPreparationGroup;

class DeleteMealPreparationGroupAction
{

    private MealPreparationGroup $group;

    public function sourceGroup(MealPreparationGroup $group) : self
    {
        $this->group = $group;
        return $this;
    }

    public function deleteGroup()
    { 
        $this->group->offerings()->sync([]);
        
        $this->group->delete();
    }

}
