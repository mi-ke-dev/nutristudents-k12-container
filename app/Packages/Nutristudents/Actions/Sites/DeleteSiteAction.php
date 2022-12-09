<?php


namespace Bytelaunch\Nutristudents\Actions\Sites;

use App\Models\User;
use Bytelaunch\Nutristudents\Models\Site;

class DeleteSiteAction
{
    private Site $site;

    public function sourceSite(Site $site) : self
    {
        $this->site = $site;
        return $this;
    }

    public function deleteSite()
    {
        $this->site->delete();
    }

}
