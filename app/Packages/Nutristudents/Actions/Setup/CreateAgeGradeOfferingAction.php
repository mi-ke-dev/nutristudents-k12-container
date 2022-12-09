<?php


namespace Bytelaunch\Nutristudents\Actions\Setup;

use Bytelaunch\Nutristudents\Models\AgeGradeOffering;

class CreateAgeGradeOfferingAction
{
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function setStarting(string $min): self
    {
        $this->starting = $min;
        return $this;
    }

    public function setEnding(string $max): self
    {
        $this->ending = $max;
        return $this;
    }


    public function create(): AgeGradeOffering
    {
        $AgeGradeOffering = AgeGradeOffering::create([
            'name' => $this->name,
            'type' => $this->type,
            'starting' => $this->starting,
            'ending' => $this->ending,
        ]);

        return $AgeGradeOffering;
    }
}
