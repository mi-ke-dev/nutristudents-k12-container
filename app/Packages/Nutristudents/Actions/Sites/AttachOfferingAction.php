<?php


namespace Bytelaunch\Nutristudents\Actions\Sites;


use Bytelaunch\Nutristudents\Models\Site;

class AttachOfferingAction
{    
    private Site $site;

    private $offerings = [];

    public function setOffering(Array $offerings_data): self
    {
        $this->offerings = $offerings_data;        
        return $this;
    }

    public function forSite(Site $site): self
    {
        $this->site = $site;
        return $this;
    }

    public function attach(): Site
    {
        $this->site->offerings()->sync($this->offerings);

        return $this->site;
    }


}
