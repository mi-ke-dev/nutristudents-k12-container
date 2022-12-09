<?php


namespace Bytelaunch\Nutristudents\Actions\Haccps;


use Bytelaunch\Nutristudents\Models\Haccp;
use SebastianBergmann\CodeCoverage\Report\Xml\Unit;

class UpdateHaccpAction
{

    private string $name;
    private string $type;
    private ?string $rule = null;
    private int $user_id;

    private Haccp $haccp;

    public function setHaccp(Haccp $haccp): self
    {
        $this->haccp = $haccp;
        return $this;
    }

    public function setName(string $name) : self
    {
        $this->haccp->name = $name;
        return $this;
    }

    public function setType(string $type) : self
    {
        $this->haccp->type = $type;
        return $this;
    }    

    public function setRule(string $rule = null) : self
    {
        $this->haccp->rule = $rule;
        return $this;
    }

    public function setUserId(int $user_id) : self
    {
        $this->haccp->user_id = $user_id;
        return $this;
    }

    

    public function update() : Haccp
    {
        $this->haccp->save();

        $haccp = $this->haccp;      

        return $haccp;
    }




}
