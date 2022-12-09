<?php


namespace Bytelaunch\Nutristudents\Actions\Haccps;

use Bytelaunch\Nutristudents\Models\Haccp;

class DeleteHaccpAction
{

    private Haccp $haccp;

    public function sourceHaccp(Haccp $haccp) : self
    {
        $this->haccp = $haccp;
        return $this;
    }

    public function deleteHaccp()
    {
        $this->haccp->delete();
    }

}
