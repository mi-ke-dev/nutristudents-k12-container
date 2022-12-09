<?php


namespace Bytelaunch\Nutristudents\Actions\Haccps;

use Bytelaunch\Nutristudents\Getters\Tenants\GetCurrentTenantGetter;
use Bytelaunch\Nutristudents\Models\Haccp;
use SebastianBergmann\CodeCoverage\Report\Xml\Unit;

class CreateHaccpAction
{

    private string $name;
    private string $type;
    private ?string $rule = null;
    private int $user_id;

    public function setName(string $name) : self
    {
        $this->name = $name;
        return $this;
    }

    public function setType(string $type) : self
    {
        $this->type = $type;
        return $this;
    }    

    public function setRule(string $rule = null) : self
    {
        $this->rule = $rule;
        return $this;
    }

    public function setUserId(int $user_id) : self
    {
        $this->user_id = $user_id;
        return $this;
    }

    

    public function create() : Haccp
    {
        $tenant_id = (new GetCurrentTenantGetter)->first()->id;
        $haccp = Haccp::create([
            'tenant_id' => $tenant_id,     
            'name' => $this->name,
            'type' => $this->type,
            'rule' => $this->rule,
            'user_id' => $this->user_id,
        ]);        

        return $haccp;
    }




}
