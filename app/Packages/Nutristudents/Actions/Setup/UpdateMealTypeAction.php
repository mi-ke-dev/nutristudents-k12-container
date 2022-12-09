<?php


namespace Bytelaunch\Nutristudents\Actions\Setup;

use Bytelaunch\Nutristudents\Models\MealType;

class UpdateMealTypeAction
{
    private MealType $mealtype;

    public function setMealType(MealType $mealtype): self
    {
        $this->mealtype = $mealtype;        
        return $this;
    }

    public function updateName(string $name): self
    {
        $this->mealtype->name = $name;
        return $this;
    }

    public function update(): MealType
    {        
        $this->mealtype->save();
        return $this->mealtype;        
    }
}
