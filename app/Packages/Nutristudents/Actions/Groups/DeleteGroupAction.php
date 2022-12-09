<?php


namespace Bytelaunch\Nutristudents\Actions\Groups;

use App\Models\User;
use Bytelaunch\Nutristudents\Models\Group;

class DeleteGroupAction
{
    private Group $group;

    public function sourceGroup(Group $group) : self
    {
        $this->group = $group;
        return $this;
    }

    public function deleteGroup()
    {
        $this->group->delete();
    }

}
