<?php


namespace Bytelaunch\Nutristudents\Actions\MenuCycleDayOptions;


use Bytelaunch\Nutristudents\Models\MenuCycleDayOption;
use Bytelaunch\Nutristudents\Models\MenuCycleDayOptionComponent;
use Bytelaunch\Nutristudents\Models\Recipe;

class UpdateOptionComponentAction
{
    private MenuCycleDayOptionComponent $menuCycleDayOptionComponent;
    private $recipes = [];
    private int $sortOrder;

    public function forMenuCycleDayOptionComponent(MenuCycleDayOptionComponent $menuCycleDayOptionComponent) : self
    {
        $this->menuCycleDayOptionComponent = $menuCycleDayOptionComponent;        
        return $this;
    }

    public function setIsExcludeFromPrintableCalendar($is_exclude_from_printable_calendar = false): self
    {
        $this->menuCycleDayOptionComponent->is_exclude_from_printable_calendar = $is_exclude_from_printable_calendar;
        return $this;
    }

    public function setIsExclude($is_exclude_export = false): self
    {
        $this->menuCycleDayOptionComponent->is_exclude_export = $is_exclude_export;
        return $this;
    }

    public function updateRecipe(Recipe $recipe, $excludeFrom = [], $cookingInstructions = null, $smartSnack = false) : self
    {        
        $this->menuCycleDayOptionComponent->recipe_id = $recipe->id;
        $this->menuCycleDayOptionComponent->cooking_instructions = $cookingInstructions;
        $this->menuCycleDayOptionComponent->exclude_from = json_encode($excludeFrom);
        $this->menuCycleDayOptionComponent->smart_snack = $smartSnack;
        return $this;
    }

    public function updateOverRide($is_override, $total_val_override): self
    {
        $this->menuCycleDayOptionComponent->is_override = $is_override;
        $this->menuCycleDayOptionComponent->total_val_override = json_encode($total_val_override);
        return $this;
    }

    public function updateSortOrder(int $sortOrder) : self
    {
        $this->menuCycleDayOptionComponent->sort_order = $sortOrder;
        return $this;
    }

    public function update() : MenuCycleDayOptionComponent
    {        
        $this->menuCycleDayOptionComponent->save();
        $menuCycleDayOptionComponentUpdate = $this->menuCycleDayOptionComponent;
        return $menuCycleDayOptionComponentUpdate;
    }


}
