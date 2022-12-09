<?php


namespace Bytelaunch\Nutristudents\Actions\Setup;

use Bytelaunch\Nutristudents\Models\AgeGradeOffering;

class DeleteAgeGradeOfferingAction
{

    private AgeGradeOffering $agegradeoffering;

    public function sourceAgeGradeOffering(AgeGradeOffering $agegradeoffering) : self
    {
        $this->agegradeoffering = $agegradeoffering;
        return $this;
    }

    public function deleteAgeGradeOffering()
    {       
        $this->agegradeoffering->delete();
    }

}
