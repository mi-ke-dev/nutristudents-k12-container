<?php


namespace Bytelaunch\Nutristudents\Actions\MenuCycleDayOptions;


use Bytelaunch\Nutristudents\Models\MenuCycleDayOption;
use Bytelaunch\Nutristudents\Models\MenuCycleDayOptionComponent;
use Bytelaunch\Nutristudents\Models\Recipe;

class CreateOptionComponentAction
{
    private MenuCycleDayOption $menuCycleDayOption;
    private $recipes = [];
    private int $sortOrder;
    private  $isExport = 0;
    private  $is_exclude_from_printable_calendar = 0;

    public function forMenuCycleDayOption(MenuCycleDayOption $menuCycleDayOption) : self
    {
        $this->menuCycleDayOption = $menuCycleDayOption;
        return $this;
    }

    public function attachRecipe(Recipe $recipe, $excludeFrom = [], $cookingInstructions = null, $smartSnack = false, $is_override = false, $total_val_override = []) : self
    {
        $this->recipes[] = [
            'object' => $recipe,
            'exclude_from' => $excludeFrom,
            'cooking_instructions' => $cookingInstructions,
            'smart_snack' => $smartSnack,
            'is_override' => $is_override,
            'total_val_override' => $total_val_override,
        ];
        return $this;
    }

    public function setSortOrder(int $sortOrder) : self
    {
        $this->sortOrder = $sortOrder;
        return $this;
    }

    public function setIsExclude($isExport): self
    {
        $this->isExport = $isExport;
        return $this;
    }

    public function setIsExcludeFromPrintableCalendar($is_exclude_from_printable_calendar = false): self
    {
        $this->is_exclude_from_printable_calendar = $is_exclude_from_printable_calendar;
        return $this;
    }

    public function create() : MenuCycleDayOption
    {
        $menuDayOptionComponents = [];
        $count = 1;
        foreach ($this->recipes as $recipe) {
            $menuDayOptionComponents[] = MenuCycleDayOptionComponent::create([
                'recipe_id' => $recipe['object']->id,
                'exclude_from' => json_encode($recipe['exclude_from']),
                'cooking_instructions' => $recipe['cooking_instructions'],
                'smart_snack' => $recipe['smart_snack'],
                'sort_order' => $count,
                'is_override' => $recipe['is_override'],
                'total_val_override' => json_encode($recipe['total_val_override']),
                'is_exclude_export' => $this->isExport,
                'is_exclude_from_printable_calendar' => $this->is_exclude_from_printable_calendar
            ]);
        $count++;
        }

        $this->menuCycleDayOption->menuCycleDayOptionComponents()->saveMany($menuDayOptionComponents);

        return $this->menuCycleDayOption;
    }


}
