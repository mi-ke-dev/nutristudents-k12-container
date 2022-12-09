<?php


namespace Bytelaunch\Nutristudents\Actions\Setup;

use Bytelaunch\Nutristudents\Models\MealType;

class DeleteMealTypeAction
{

    private MealType $mealtype;

    public function sourceMealType(MealType $mealtype) : self
    {
        $this->mealtype = $mealtype;
        return $this;
    }

    public function deleteMealType()
    {       

        $this->mealtype->delete();

    }

}
