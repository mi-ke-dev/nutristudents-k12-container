<?php


namespace Bytelaunch\Nutristudents\Actions\Haccps;

use Bytelaunch\Nutristudents\Getters\Tenants\GetCurrentTenantGetter;
use Bytelaunch\Nutristudents\Models\Haccp;

class CopyHaccpAction
{

    private Haccp $haccp;

    public function sourceHaccp(Haccp $haccp) : self
    {
        $this->haccp = $haccp;
        return $this;
    }

    public function copy()
    {

        $newHaccp = $this->haccp->replicate();
        $newHaccp->name .= ' (Copy)';
        $newHaccp->tenant_id = (new GetCurrentTenantGetter)->first()->id;     
        $newHaccp->save();

        return $newHaccp;

    }






}
