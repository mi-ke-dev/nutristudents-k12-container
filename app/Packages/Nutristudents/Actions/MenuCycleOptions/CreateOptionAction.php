<?php


namespace Bytelaunch\Nutristudents\Actions\MenuCycleOptions;


use Bytelaunch\Nutristudents\Models\MenuCycleDay;
use Bytelaunch\Nutristudents\Models\MenuCycleDayOption;

class CreateOptionAction
{

    private MenuCycleDay $menuCycleDay;
    private string $image;
    private int $sortOrder = 0;
    private string $name ;
    private $isFavorite = false;
    private $assembly_serving = null;
    private $assembly_serving_unit = null;
    private $assembly_instructions = null;
    private $is_exclude_from_export = false;
    private $a_la_carte = false;
    private $assembly_serving_free_text = null;

    public function forMenuCycleDay(MenuCycleDay $menuCycleDay): self
    {
        $this->menuCycleDay = $menuCycleDay;
        return $this;
    }

    public function setIsExclude($is_exclude_from_export = false): self
    {
        $this->is_exclude_from_export = $is_exclude_from_export;
        return $this;
    }

    public function setAssembly($assembly_serving_free_text = null, $assembly_serving = null, $assembly_serving_unit= null, $assembly_instructions= null): self
    {
        $this->assembly_serving_free_text = $assembly_serving_free_text;
        $this->assembly_serving = $assembly_serving;
        $this->assembly_serving_unit = $assembly_serving_unit;
        $this->assembly_instructions = $assembly_instructions;
        return $this;
    }

    public function setIsFavorite($isFavorite): self
    {
        $this->isFavorite = $isFavorite;
        return $this;
    }

    public function setALaCarte($a_la_carte): self
    {
        $this->a_la_carte = $a_la_carte;
        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;
        return $this;
    }

    public function setSortOrder(int $sortOrder = 0): self
    {
        $this->sortOrder = $sortOrder;
        return $this;
    }

    public function create(): MenuCycleDayOption
    {
        $array = [
            'photo_store_path' => $this->image,
            'sort_order' => $this->sortOrder,
            'is_favorite' => $this->isFavorite,
            'assembly_serving_free_text' => $this->assembly_serving_free_text,
            'assembly_serving' => $this->assembly_serving,
            'assembly_serving_unit' => $this->assembly_serving_unit,
            'assembly_instructions' => $this->assembly_instructions,
            'is_exclude_from_export' => $this->is_exclude_from_export,
            'a_la_carte' => $this->a_la_carte
        ];
        if($this->name){
            $array['name'] = $this->name;
        }
        $menuCycleDayOption = MenuCycleDayOption::make($array);
        $menuCycleDayOption->menuCycleDay()->associate($this->menuCycleDay)->save();
        return $menuCycleDayOption;
    }


}
