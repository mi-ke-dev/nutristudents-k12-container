<?php


namespace Bytelaunch\Nutristudents\Actions\MenuCreationGroups;
use Bytelaunch\Nutristudents\Models\MenuCreationGroup;

class SyncOfferingAction
{
    private $offerings = [];
    private MenuCreationGroup $menu_creation_group;

    public function forMenuCreationGroup(MenuCreationGroup $menu_creation_group): self
    {
        $this->menu_creation_group = $menu_creation_group;
        return $this;
    }

    public function attachOffering($offerings): self
    {
        $this->offerings = $offerings;
        return $this;
    }

    public function attach(): MenuCreationGroup
    {
        if (count($this->offerings) > 0) {
            $this->menu_creation_group->offerings()->sync($this->offerings);
        } else {
            $this->menu_creation_group->offerings()->sync([]);
        }
        return $this->menu_creation_group;
    }

}
