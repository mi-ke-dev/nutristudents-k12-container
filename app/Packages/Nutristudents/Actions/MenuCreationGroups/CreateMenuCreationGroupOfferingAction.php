<?php


namespace Bytelaunch\Nutristudents\Actions\MenuCreationGroups;
use Bytelaunch\Nutristudents\Models\MenuCreationGroupOffering;

class CreateMenuCreationGroupOfferingAction
{    
    private string $menu_creation_group_id;
    private string $offering_id;
    

    public function setGroupId(string $menu_creation_group_id): self
    {               
        $this->menu_creation_group_id = $menu_creation_group_id;
        return $this;
    }

    public function setOfferingId(string $offering_id): self
    {               
        $this->offering_id = $offering_id;
        return $this;
    }

    public function create(): MenuCreationGroupOffering
    {
        $group = MenuCreationGroupOffering::create([
            'menu_creation_group_id' => $this->menu_creation_group_id,
            'offering_id' => $this->offering_id
        ]);
        return $group;
    }
}
