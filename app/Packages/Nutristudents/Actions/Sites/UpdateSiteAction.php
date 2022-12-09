<?php


namespace Bytelaunch\Nutristudents\Actions\Sites;


use App\Models\User;
use Bytelaunch\Nutristudents\Models\Site;

class UpdateSiteAction
{
    private string $name;
    private Site $site;

    public function setSite(Site $site): self
    {
        $this->site = $site;
        return $this;
    }

    public function setName(string $name): self
    {
        $this->site->name = $name;
        return $this;
    }


    public function update(): Site
    {
        $this->site->save();
        $site = $this->site;
        return $site;
    }
}
