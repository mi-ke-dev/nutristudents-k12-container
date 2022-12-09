<?php


namespace Bytelaunch\Nutristudents\Actions\Setup;

use Bytelaunch\Nutristudents\Models\MealType;

class CreateMealTypeAction
{
    private string $name;

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }


    public function create(): MealType
    {
        $mealtype = MealType::create([
            'name' => $this->name,
        ]);

        return $mealtype;
    }
}
