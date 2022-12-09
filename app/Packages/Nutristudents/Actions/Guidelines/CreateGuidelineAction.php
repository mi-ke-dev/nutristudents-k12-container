<?php


namespace Bytelaunch\Nutristudents\Actions\Guidelines;

use Bytelaunch\Nutristudents\Getters\Tenants\GetCurrentTenantGetter;
use Bytelaunch\Nutristudents\Models\Guideline;

class CreateGuidelineAction
{
    private $data = [];

    public function setData(Array $guideline_data): self
    {        
        $this->data = $guideline_data;
        return $this;
    }


    public function create(): Guideline
    {
        $data = $this->data;
        $data['tenant_id'] = (new GetCurrentTenantGetter)->first()->id;
        $guideline = Guideline::create($data);
        return $guideline;
    }
}
