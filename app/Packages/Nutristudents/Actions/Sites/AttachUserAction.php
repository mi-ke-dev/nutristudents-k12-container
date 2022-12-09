<?php

namespace Bytelaunch\Nutristudents\Actions\Sites;


use Bytelaunch\Nutristudents\Models\Site;

class AttachUserAction
{    
    private Site $site;

    private $users = [];

    public function setUser(Array $users_data, $permissions): self
    {
        //$this->users = $users_data;

        if(!empty($permissions)){
        for($i = 0; $i < count($users_data); $i++){
           $this->users[$users_data[$i]] = $permissions[$i];
        }    
        }

        return $this;
    }

    public function forSite(Site $site): self
    {
        $this->site = $site;
        return $this;
    }

    public function attach(): Site
    {
        $this->site->users()->sync($this->users);

        return $this->site;
    }


}
