<?php


namespace Bytelaunch\Nutristudents\Actions\Groups;


use App\Models\User;
use Bytelaunch\Nutristudents\Models\Group;
use Bytelaunch\Nutristudents\Models\Site;

class UpdateGroupAction
{
    private string $name;
    private string $groupType;
    private User $groupAdmin;

    private Group $group;

    private $users = [];
    private $permissions = [];

    public function setGroup(Group $group): self
    {
        $this->group = $group;
        return $this;
    }

    public function setName(string $name): self
    {
        $this->group->name = $name;
        return $this;
    }

    public function setGroupType(string $groupType): self
    {
        $this->group->group_type = $groupType;
        return $this;
    }


    public function setGroupAdmin(User $groupAdmin): self
    {
        $this->group->group_admin_id = $groupAdmin;
        return $this;
    }


    public function updateUserToGroup(User $user, $permission_data) : self
    {
        $this->permissions[] = $permission_data;

        $this->users[] = $user;
        return $this;
    }


    public function update(): Group
    {
        $this->group->save();
        $group = $this->group;    

        if (count($this->users) > 0) {
            $user = (new SyncUserAction())
                ->forGroup($group)
                ->attachUserToGroup($this->users, $this->permissions)->attach();
        }             

        return $group;
    }
}
