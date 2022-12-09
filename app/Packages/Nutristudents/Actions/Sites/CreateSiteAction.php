<?php


namespace Bytelaunch\Nutristudents\Actions\Sites;


use App\Models\User;
use Bytelaunch\Nutristudents\Models\Site;

class CreateSiteAction
{
    private string $name;

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }


    public function create(): Site
    {
        $site = Site::create([
            'name' => $this->name,
        ]);

        return $site;
    }
}
