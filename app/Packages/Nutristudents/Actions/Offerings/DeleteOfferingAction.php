<?php


namespace Bytelaunch\Nutristudents\Actions\Offerings;

use Bytelaunch\Nutristudents\Models\Offering;

class DeleteOfferingAction
{
    private Offering $offering;

    public function sourceOffering(Offering $offering) : self
    {
        $this->offering = $offering;
        return $this;
    }

    public function deleteOffering()
    {
        $this->offering->delete();
    }

}
