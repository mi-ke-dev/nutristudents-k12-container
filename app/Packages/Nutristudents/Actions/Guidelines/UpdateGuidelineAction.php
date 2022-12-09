<?php

namespace Bytelaunch\Nutristudents\Actions\Guidelines;


use Bytelaunch\Nutristudents\Models\Guideline;

class UpdateGuidelineAction
{
    private $data = [];
    private Guideline $guideline;

    public function setGuideline(Guideline $guideline): self
    {
        $this->guideline = $guideline;
        return $this;
    }

    public function setData(Array $guideline_data): self
    {
        $this->data = $guideline_data;
        return $this;
    }


    public function update(): Guideline
    {                
        $this->guideline->update($this->data);                    

        return $this->guideline;
    }
}
