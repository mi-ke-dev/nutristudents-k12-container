<?php


namespace Bytelaunch\Nutristudents\Actions\Guidelines;

use Bytelaunch\Nutristudents\Models\Guideline;

class DeleteGuidelineAction
{
    private Guideline $guideline;

    public function sourceGuideline(Guideline $guideline) : self
    {
        $this->guideline = $guideline;
        return $this;
    }

    public function deleteGuideline()
    {
        $this->guideline->delete();
    }

}
