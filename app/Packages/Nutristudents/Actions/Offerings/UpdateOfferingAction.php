<?php


namespace Bytelaunch\Nutristudents\Actions\Offerings;


use App\Models\User;
use Bytelaunch\Nutristudents\Models\Guideline;
use Bytelaunch\Nutristudents\Models\Offering;
use Bytelaunch\Nutristudents\Models\Site;

class UpdateOfferingAction
{
    private string $name;
    private string $site;
    private string $guideline;
    private string $prepSite;
    private string $cookSite;

    private Offering $offering;

    public function setOffering(Offering $offering): self
    {
        $this->offering = $offering;
        return $this;
    }


    public function setName(string $name): self
    {
        $this->offering->name = $name;
        return $this;
    }


    public function forSite(string $site): self
    {
        $this->offering->site_id = $site;
        return $this;
    }


    public function forGuideline(string $guideline): self
    {
        $this->offering->guideline_id = $guideline;
        return $this;
    }

    // public function forMenuAdmin(string $menuAdminId, string $menuAdminType): self
    // {
    //     $this->offering->menu_adminable_id = $menuAdminId;
    //     $this->offering->menu_adminable_type = $menuAdminType;
    //     return $this;
    // }

    // public function forOrderAdmin(string $orderAdminId, string $orderAdminType): self
    // {
    //     $this->offering->order_adminable_id = $orderAdminId;
    //     $this->offering->order_adminable_type = $orderAdminType;
    //     return $this;
    // }

    // public function forPrepSite(string $prepSite): self
    // {
    //     $this->offering->prep_site_id = $prepSite;
    //     return $this;
    // }

    // public function forCookSite(string $cookSite): self
    // {
    //     $this->offering->cook_site_id = $cookSite;
    //     return $this;
    // }


    public function update(): Offering
    {        
        $this->offering->save();
        
        $offering = $this->offering;        
        
        return $offering;
    }
}
