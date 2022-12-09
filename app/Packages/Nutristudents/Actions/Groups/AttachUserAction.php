<?php


namespace Bytelaunch\Nutristudents\Actions\Groups;


use Bytelaunch\Nutristudents\Models\Group;

class AttachUserAction
{    
    private Group $group;

    private $users = [];

    public function setUser(Array $users_data, $permissions): self
    {
        $this->users = $users_data;

        if(!empty($permissions)){
        for($i = 0; $i < count($users_data); $i++){
           $this->users[$users_data[$i]] = $permissions[$i];
        }    
        }

        return $this;
    }

    public function forGroup(Group $group): self
    {
        $this->group = $group;
        return $this;
    }

    public function attach(): Group
    {
        $this->group->users()->sync($this->users);

        return $this->group;
    }


}
