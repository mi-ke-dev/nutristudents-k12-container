<?php


namespace Bytelaunch\Nutristudents\Actions\Setup;

use Bytelaunch\Nutristudents\Models\Days;

class DeleteDaysAction
{

    private Days $days;

    public function sourceDays(Days $days) : self
    {
        $this->days = $days;
        return $this;
    }

    public function deleteDays()
    {       

        $this->days->delete();

    }

}
