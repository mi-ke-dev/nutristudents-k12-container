<?php


namespace Bytelaunch\Nutristudents\Actions\Users;

use App\Models\User;
use Bytelaunch\Nutristudents\Models\Site;
use Bytelaunch\Nutristudents\Models\Group;
use Bytelaunch\Nutristudents\Actions\Users\AttachSiteAction;
use Bytelaunch\Nutristudents\Actions\Users\AttachGroupAction;

class CreateUserAction
{

    private string $name;
    private string $type;
    private string $email;
    private string $password;

    private $sites = [];
    private $permissions = [];

    private $groups = [];
    private $grp_permissions = [];

    public function setName(string $name) : self
    {
        $this->name = $name;        
        return $this;
    }

    public function setType(string $type) : self
    {
        $this->type = $type;
        return $this;
    }    

    public function setEmail(string $email) : self
    {
        $this->email = $email;
        return $this;
    }

    public function setPassword(string $password) : self
    {
        $this->password = $password;
        return $this;
    }

    public function addSiteToUser(Site $site, $permission_data) : self
    {
        $this->permissions[] = $permission_data;

        $this->sites[] = $site;
        return $this;
    }

    public function addGroupToUser(Group $group, $grp_permission_data) : self
    {
        $this->grp_permissions[] = $grp_permission_data;

        $this->groups[] = $group;
        return $this;
    }

    public function create() : User
    {                
        $user = User::create([
            'name' => $this->name,
            'type' => $this->type,
            'email' => $this->email,
            'password' => $this->password,
        ]);  

        if (count($this->sites) > 0) {
            $user = (new AttachSiteAction())
                ->forUser($user)
                ->attachSiteToUser($this->sites, $this->permissions)->attach();
        } 

        if (count($this->groups) > 0) {
            $user = (new AttachGroupAction())
                ->forUser($user)
                ->attachGroupToUser($this->groups, $this->grp_permissions)->attach();
        }     

        return $user;
    }




}
