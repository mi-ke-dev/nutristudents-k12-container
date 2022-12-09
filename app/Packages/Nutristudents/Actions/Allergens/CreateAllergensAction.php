<?php


namespace Bytelaunch\Nutristudents\Actions\Allergens;


use App\Models\User;
use Bytelaunch\Nutristudents\Models\Allergen;

class CreateAllergensAction
{
    private string $name;

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function create(): Allergen
    {
        $Allergen = Allergen::create([
            'name' => $this->name
        ]);

        return $Allergen;
    }
}
