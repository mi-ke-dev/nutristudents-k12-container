<?php


namespace Bytelaunch\Nutristudents\Actions\MealPreparationGroups;
use Bytelaunch\Nutristudents\Models\MealPreparationGroup;

class CreateMealPreparationGroupAction
{
    private string $name;    
    private string $ageRange;
    private string $daysId;
    private string $guideline_id;
    private $offerings = [];
    
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function setMealType(string $mealType): self
    {
        $this->meal_type_id = $mealType;
        return $this;
    }

    public function setAgeRange(string $ageRange): self
    {               
        $this->age_grade_offering_id = $ageRange;
        return $this;
    }

    public function setDays(string $daysId): self
    {               
        $this->day_id = $daysId;
        return $this;
    }

    public function setGuideline(string $guideline_id) : self
    {
        $this->guideline_id = $guideline_id;
        return $this;
    }

    public function setOffering($offerings){
        $this->offerings = $offerings;            
        return $this;
    }

    public function create(): MealPreparationGroup
    {
        $group = MealPreparationGroup::create([
            'name' => $this->name,
            'meal_type_id' => $this->meal_type_id
            // 'age_grade_offering_id' => $this->age_grade_offering_id,
            // 'day_id' => $this->day_id,
            // 'guideline_id'=>$this->guideline_id
        ]);

        if (count($this->offerings) > 0) {
            $soffer = collect($this->offerings)->pluck('id')->toArray();
            $group->offerings()->sync($soffer);
        }
        return $group;
    }
}
