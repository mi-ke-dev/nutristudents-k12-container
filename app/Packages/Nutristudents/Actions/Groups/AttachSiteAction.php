<?php


namespace Bytelaunch\Nutristudents\Actions\Groups;


use Bytelaunch\Nutristudents\Models\Group;

class AttachSiteAction
{    
    private Group $group;

    private $sites = [];

    public function setSite(Array $sites_data): self
    {
        $this->sites = $sites_data;        
        return $this;
    }

    public function forGroup(Group $group): self
    {
        $this->group = $group;
        return $this;
    }

    public function attach(): Group
    {
        $this->group->sites()->sync($this->sites);

        return $this->group;
    }


}
