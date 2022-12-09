<?php


namespace Bytelaunch\Nutristudents\Actions\MenuCycles;

use Bytelaunch\Nutristudents\Getters\Tenants\GetCurrentTenantGetter;
use Bytelaunch\Nutristudents\Models\Grade;
use Bytelaunch\Nutristudents\Models\GradeRange;
use Bytelaunch\Nutristudents\Models\Offering;
use Bytelaunch\Nutristudents\Models\MenuCycle;

class CreateMenuCycleAction
{
    private ?string $name;    
    private string $ageRange;
    private string $daysId;
    private string $guideline_id;
    private int $week_number;
    private $is_template=true;
    
    private ?int $user_id = null;

    public function setIsTemplate($is_template): self
    {
        $this->is_template = $is_template;
        return $this;
    }

    //setWeekNumber
    public function setWeekNumber(int $week_number): self
    {
        $this->week_number = $week_number;
        return $this;
    }

    public function setName(?string $name): self
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
        $this->age_grade_id = $ageRange;
        return $this;
    }

    public function setDays(string $daysId): self
    {               
        $this->days_id = $daysId;
        return $this;
    }

    public function setUserId(int $user_id) : self
    {
        $this->user_id = $user_id;
        return $this;
    }

    public function setGuideline(string $guideline_id) : self
    {
        $this->guideline_id = $guideline_id;
        return $this;
    }

    public function create(): MenuCycle
    {
        // dd($this->is_template);
        $tenant_id = (new GetCurrentTenantGetter)->first()->id;
        $menuCycle = MenuCycle::create([
            'tenant_id' => $tenant_id,
            'name' => $this->name,
            'meal_type_id' => $this->meal_type_id,
            'age_grade_id' => $this->age_grade_id,
            'days_id' => $this->days_id,
            'user_id' => $this->user_id,
            'guideline_id'=>$this->guideline_id,
            'week_number' => $this->week_number,
            'is_template' => $this->is_template
        ]);

        // $menuCycle = (new AttachGradeRangeAction())
        //     ->forMenuCycle($menuCycle)
        //     ->setGradeRange($this->gradeRange)
        //     ->attach();

        return $menuCycle;
    }


}
