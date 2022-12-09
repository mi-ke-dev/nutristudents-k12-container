<?php


namespace Bytelaunch\Nutristudents\Actions\Setup;

use Bytelaunch\Nutristudents\Models\AgeGradeOffering;

class UpdateAgeGradeOfferingAction
{
    private AgeGradeOffering $agegradeoffering;

    public function setAgeGrade(AgeGradeOffering $agegradeoffering): self
    {        
        $this->agegradeoffering = $agegradeoffering;        
        return $this;
    }

    public function updateName(string $name): self
    {
        $this->agegradeoffering->name = $name;
        return $this;
    }

    public function updateType(string $type): self
    {
        $this->agegradeoffering->type = $type;
        return $this;
    }

    public function updateStarting(string $min): self
    {
        $this->agegradeoffering->starting = $min;
        return $this;
    }

    public function updateEnding(string $max): self
    {
        $this->agegradeoffering->ending = $max;
        return $this;
    }


    public function update(): AgeGradeOffering
    {  
        $this->agegradeoffering->save();
        return $this->agegradeoffering;
    }
}
