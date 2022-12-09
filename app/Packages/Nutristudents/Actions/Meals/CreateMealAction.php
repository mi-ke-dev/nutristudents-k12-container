<?php


namespace Bytelaunch\Nutristudents\Actions\Meals;


use Bytelaunch\Nutristudents\Models\Meal;
use Bytelaunch\Nutristudents\Models\Site;

class CreateMealAction
{

    private string $name;
    private Site $site;

    public function setName(string $name) : self
    {
        $this->name = $name;
        return $this;
    }

    public function setSite(Site $site) : self
    {
        $this->site = $site;
        return $this;
    }

    public function create() : Meal
    {
        $meal = Meal::make([
            'name' => $this->name
        ]);

        $meal->site()->associate($this->site)->save();

        return $meal;
    }


}
