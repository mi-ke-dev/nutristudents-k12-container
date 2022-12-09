<?php


namespace Bytelaunch\Nutristudents\Actions\Users;

use App\Models\User;
use Bytelaunch\Nutristudents\Models\Site;
use Bytelaunch\Nutristudents\Models\Group;
use Bytelaunch\Nutristudents\Actions\Users\AttachSiteAction;
use Bytelaunch\Nutristudents\Actions\Users\AttachGroupAction;
use Bytelaunch\Nutristudents\Actions\Users\SyncSiteAction;
use Bytelaunch\Nutristudents\Actions\Users\SyncGroupAction;
use Bytelaunch\Nutristudents\Models\UserPermission;

class UpdateUserAction
{

    private string $name;
    private string $type;
    private string $email;

    private $templates = [];
    private $menuPlaning = [];
    private $headcounts = [];
    private $food_preparation = [];

    private $menuPlaningGroup = [];
    private $food_preparation_group = [];

    private $sites = [];
    private $permissions = [];

    private $groups = [];
    private $grp_permissions = [];

    private User $user;

    public function setFMenuPlanningGroup($menuPlaningGroup): self
    {
        $this->menuPlaningGroup = $menuPlaningGroup;
        return $this;
    }

    public function setFoodPreparationGroup($food_preparation_group): self
    {
        $this->food_preparation_group = $food_preparation_group;
        return $this;
    }

    public function setFoodPreparation($food_preparation): self
    {
        $this->food_preparation = $food_preparation;
        return $this;
    }

    public function setHeadcounts($headcounts): self
    {
        $this->headcounts = $headcounts;
        return $this;
    }

    public function setTemplates($templates): self
    {
        $this->templates = $templates;
        return $this;
    }

    public function setMenuPlaning($menuPlaning = []): self
    {
        $this->menuPlaning = $menuPlaning;
        return $this;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;
        return $this;
    }

    public function setName(string $name) : self
    {
        $this->user->name = $name;
        return $this;
    }

    public function setType(string $type) : self
    {
        $this->user->type = $type;
        return $this;
    }    

    public function setEmail(string $email) : self
    {
        $this->user->email = $email;
        return $this;
    }
    

    public function updateSiteToUser(Site $site, $permission_data) : self
    {
        $this->permissions[] = $permission_data;

        $this->sites[] = $site;
        return $this;
    }

    public function updateGroupToUser(Group $group, $grp_permission_data) : self
    {
        $this->grp_permissions[] = $grp_permission_data;

        $this->groups[] = $group;
        return $this;
    }
    

    public function update() : User
    {        
        $this->user->save();
        
        $user = $this->user; 

        foreach($this->templates as $key => $temp){
            $uPer = UserPermission::where('user_id', $user->id)
            ->where('type', 'templates')
            ->where('template_type', $key)
            ->first();
            if($uPer){
                $uPer->is_access = $temp;
                $uPer->save();
            }
             UserPermission::create(
                [
                    'user_id'=> $user->id, 
                    'type' => 'templates',
                    'template_type' => $key,
                    'is_access' => $temp
                ] 
            );
            
        }

        $this->updatePermission($this->menuPlaning, 'menu_planings');
        $this->updatePermission($this->headcounts, 'headcounts');
        $this->updatePermission($this->food_preparation, 'food_preparation');

        $this->updatePermissionGroup($this->food_preparation_group, 'food_preparation');
        $this->updatePermissionGroup($this->menuPlaningGroup, 'menu_planings');
        // $this->updatePermission($this->menuPlaning, 'menu_planings');
        // $this->updatePermission($this->menuPlaning, 'menu_planings');
        

        // dd($this->menuPlaning);

        // if (count($this->sites) > 0) {
        //     $user = (new SyncSiteAction())
        //         ->forUser($user)
        //         ->attachSiteToUser($this->sites, $this->permissions)->attach();
        // } 

        // if (count($this->groups) > 0) {
        //     $user = (new SyncGroupAction())
        //         ->forUser($user)
        //         ->attachGroupToUser($this->groups, $this->grp_permissions)->attach();
        // }    

        return $user;
    }

    public function updatePermissionGroup($arrays =[], $type){
        $menu_planings = [];
        foreach($arrays as $offering){
            $menu_planings[] = $offering['id'];
        }
        UserPermission::where('type', $type)
        ->where('user_id', $this->user->id)
        ->whereNotIn('group_id', $menu_planings)
        ->whereNotNull('group_id')
        ->delete();
        foreach($arrays as $offering){
            $uPer = UserPermission::firstOrNew(
                [
                    'user_id'=> $this->user->id, 
                    'type' => $type,
                    'group_id' => $offering['id']
                ] 
            );
            $uPer->save();
        }
    }

    public function updatePermission($arrays =[], $type){
        $menu_planings = [];
        foreach($arrays as $offering){
            $menu_planings[] = $offering['id'];
        }
        UserPermission::where('type', $type)
        ->where('user_id', $this->user->id)
        ->whereNotIn('offering_id', $menu_planings)
        ->whereNotNull('offering_id')
        ->delete();
        foreach($arrays as $offering){
            $uPer = UserPermission::firstOrNew(
                [
                    'user_id'=> $this->user->id, 
                    'type' => $type,
                    'offering_id' => $offering['id']
                ] 
            );
            $uPer->site_id = $offering['site_id'];
            $uPer->save();
        }
    }




}
