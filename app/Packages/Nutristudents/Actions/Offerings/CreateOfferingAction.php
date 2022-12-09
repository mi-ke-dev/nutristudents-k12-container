<?php


namespace Bytelaunch\Nutristudents\Actions\Offerings;


use App\Models\User;
use Bytelaunch\Nutristudents\Models\Guideline;
use Bytelaunch\Nutristudents\Models\Offering;
use Bytelaunch\Nutristudents\Models\Site;

class CreateOfferingAction
{
    private string $name;
    private Site $site;
    private Guideline $guideline;
    private $menuAdmin;
    private $orderAdmin;
    private Site $prepSite;
    private Site $cookSite;


    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }


    public function forSite(Site $site): self
    {
        $this->site = $site;
        return $this;
    }


    public function forGuideline(Guideline $guideline): self
    {
        $this->guideline = $guideline;
        return $this;
    }

    public function forMenuAdmin($menuAdmin): self
    {
        $this->menuAdmin = $menuAdmin;
        return $this;
    }

    public function forOrderAdmin($orderAdmin): self
    {
        $this->orderAdmin = $orderAdmin;
        return $this;
    }

    public function forPrepSite(Site $prepSite): self
    {
        $this->prepSite = $prepSite;
        return $this;
    }

    public function forCookSite(Site $cookSite): self
    {
        $this->cookSite = $cookSite;
        return $this;
    }


    public function create(): Offering
    {        
        $offering = Offering::make([
            'name' => $this->name
            // ,
            // 'prep_site_id' => $this->prepSite->id,
            // 'cook_site_id' => $this->cookSite->id,
        ]);
        
        $offering->site()->associate($this->site);
        $offering->guideline()->associate($this->guideline);
        // $offering->cook_site()->associate($this->cookSite);
        // $offering->prep_site()->associate($this->prepSite);
        // $offering->menu_adminable()->associate($this->menuAdmin);
        // $offering->order_adminable()->associate($this->orderAdmin);

        $offering->save();        
        
        return $offering;
    }
}
