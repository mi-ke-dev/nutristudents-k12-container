<?php


namespace Bytelaunch\Nutristudents\Actions\Groups;


use App\Models\User;
use Bytelaunch\Nutristudents\Models\Group;
use Bytelaunch\Nutristudents\Models\Site;

class CreateGroupAction
{
    private string $name;
    private string $groupType;
    private User $groupAdmin;

    private $sites = [];

    private $users = [];
    private $permissions = [];

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function setGroupType(string $groupType): self
    {
        $this->groupType = $groupType;
        return $this;
    }


    public function setGroupAdmin(User $groupAdmin): self
    {
        $this->groupAdmin = $groupAdmin;
        return $this;
    }

    public function addUserToGroup(User $user, $permission_data) : self
    {
        $this->permissions[] = $permission_data;

        $this->users[] = $user;
        return $this;
    }


    public function create(): Group
    {
        // $group = Group::make([
        //     'name' => $this->name,
        //     'group_type' => $this->groupType,
        // ]);

        //$group->group_admin()->associate($this->groupAdmin)->save();

        $group = Group::create([
            'name' => $this->name,
            'group_type' => $this->groupType,
        ]);

        if (count($this->users) > 0) {
            $group = (new AttachUserAction())
                ->forGroup($group)
                ->attachUserToGroup($this->users, $this->permissions)->attach();
        }

        return $group;
    }
}
