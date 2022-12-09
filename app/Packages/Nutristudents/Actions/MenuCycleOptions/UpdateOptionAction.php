<?php


namespace Bytelaunch\Nutristudents\Actions\MenuCycleOptions;

use Bytelaunch\Nutristudents\Models\MenuCycleDayOption;

class UpdateOptionAction
{

    private MenuCycleDayOption $menuCycleDayOption;
    private string $image;
    private int $sortOrder = 0;

    public function forMenuCycleDayOption(MenuCycleDayOption $menuCycleDayOption): self
    {
        $this->menuCycleDayOption = $menuCycleDayOption;
        return $this;
    }

    public function setIsExclude($is_exclude_from_export = false): self
    {
        $this->menuCycleDayOption->is_exclude_from_export = $is_exclude_from_export;
        return $this;
    }

    public function setAssembly($assembly_serving_free_text = null, $assembly_serving = null, $assembly_serving_unit= null, $assembly_instructions= null): self
    {
        $this->menuCycleDayOption->assembly_serving_free_text = $assembly_serving_free_text;
        $this->menuCycleDayOption->assembly_serving = $assembly_serving;
        $this->menuCycleDayOption->assembly_serving_unit = $assembly_serving_unit;
        $this->menuCycleDayOption->assembly_instructions = $assembly_instructions;
        return $this;
    }
 
    public function updateALaCarte($a_la_carte=false): self
    {
        $this->menuCycleDayOption->a_la_carte = $a_la_carte;
        return $this;
    }

    public function updateisFavorite($isFavorite=false): self
    {
        $this->menuCycleDayOption->is_favorite = $isFavorite;
        return $this;
    }

    public function updateName(string $name): self
    {
        $this->menuCycleDayOption->name = $name;
        return $this;
    }

    public function updateImage(string $image): self
    {
        $this->menuCycleDayOption->photo_store_path = $image;
        return $this;
    }

    public function updateSortOrder(int $sortOrder = 0): self
    {
        $this->menuCycleDayOption->sort_order = $sortOrder;
        return $this;
    }

    public function update(): MenuCycleDayOption
    {
       //dd($this->menuCycleDayOption);
        $this->menuCycleDayOption->save();
        $menuCycleDayOptionUpdate = $this->menuCycleDayOption;
        return $menuCycleDayOptionUpdate;
    }


}
