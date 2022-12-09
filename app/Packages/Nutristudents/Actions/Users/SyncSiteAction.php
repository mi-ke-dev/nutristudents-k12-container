<?php


namespace Bytelaunch\Nutristudents\Actions\Users;


use App\Models\User;

class SyncSiteAction
{
    private User $user;

    private $sites = [];

    public function forUser(User $user): self
    {
        $this->user = $user;
        return $this;
    }

    public function attachSiteToUser($site, $permissions): self
    {        
        if(!empty($permissions)){
        for($i = 0; $i < count($site); $i++){
           $this->sites[$site[$i]->id] = $permissions[$i];
        }    
        }
            
        return $this;
    }

    public function attach(): User
    {

        if (count($this->sites) > 0) {
            $this->user->sites()->sync($this->sites);
        }else{
            $this->user->sites()->sync([]);
        }

        return $this->user;
    }


}
