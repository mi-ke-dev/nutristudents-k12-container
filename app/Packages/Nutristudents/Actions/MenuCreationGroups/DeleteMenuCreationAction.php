<?php


namespace Bytelaunch\Nutristudents\Actions\MenuCreationGroups;
use Bytelaunch\Nutristudents\Models\MenuCreationGroup;

class DeleteMenuCreationAction
{

    private MenuCreationGroup $group;

    public function sourceGroup(MenuCreationGroup $group) : self
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
