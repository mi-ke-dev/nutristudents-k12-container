<?php


namespace Bytelaunch\Nutristudents\Actions\Guidelines;

use Bytelaunch\Nutristudents\Getters\Tenants\GetCurrentTenantGetter;
use Bytelaunch\Nutristudents\Models\Guideline;

class CopyGuidelineAction
{

    private Guideline $guideline;

    public function sourceGuideline(Guideline $guideline) : self
    {
        $this->guideline = $guideline;
        return $this;
    }

    public function copy()
    {
        $newGuideline = $this->guideline->replicate();
        $newGuideline->name .= ' (Copy)';
        $newGuideline->tenant_id = (new GetCurrentTenantGetter)->first()->id;
        $newGuideline->save();
        return $newGuideline;
    }






}
