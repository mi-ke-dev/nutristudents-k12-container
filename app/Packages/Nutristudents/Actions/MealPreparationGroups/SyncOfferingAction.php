<?php


namespace Bytelaunch\Nutristudents\Actions\MealPreparationGroups;
use Bytelaunch\Nutristudents\Models\MealPreparationGroup;

class SyncOfferingAction
{
    private $offerings = [];
    private MealPreparationGroup $menu_creation_group;

    public function forMealPreparationGroup(MealPreparationGroup $menu_creation_group): self
    {
        $this->menu_creation_group = $menu_creation_group;
        return $this;
    }

    public function attachOffering($offerings): self
    {
        $this->offerings = $offerings;
        return $this;
    }

    public function attach(): MealPreparationGroup
    {
        if (count($this->offerings) > 0) {
            $this->menu_creation_group->offerings()->sync($this->offerings);
        } else {
            $this->menu_creation_group->offerings()->sync([]);
        }
        return $this->menu_creation_group;
    }

}
