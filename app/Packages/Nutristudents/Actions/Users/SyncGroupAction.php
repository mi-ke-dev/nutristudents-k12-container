<?php


namespace Bytelaunch\Nutristudents\Actions\Users;


use App\Models\User;

class SyncGroupAction
{
    private User $user;

    private $groups = [];

    public function forUser(User $user): self
    {
        $this->user = $user;
        return $this;
    }

    public function attachGroupToUser($group, $permissions): self
    {        
        //dd($site, $permissions);
        if(!empty($permissions)){
        for($i = 0; $i < count($group); $i++){
           $this->groups[$group[$i]->id] = $permissions[$i];
        }    
        }
            
        return $this;
    }

    public function attach(): User
    {

        if (count($this->groups) > 0) {
            $this->user->groups()->sync($this->groups);
        }else{
            $this->user->groups()->sync([]);
        }

        return $this->user;
    }


}
