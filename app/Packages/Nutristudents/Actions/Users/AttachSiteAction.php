<?php


namespace Bytelaunch\Nutristudents\Actions\Users;


use App\Models\User;

class AttachSiteAction
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
        //dd($site, $permissions);
        if(!empty($permissions)){
        for($i = 0; $i < count($site); $i++){
           $this->sites[$site[$i]->id] = $permissions[$i];
        }    
        }
            
        return $this;
    }

    public function attach(): User
    {
        $this->user->sites()->attach($this->sites);

        return $this->user;
    }


}
