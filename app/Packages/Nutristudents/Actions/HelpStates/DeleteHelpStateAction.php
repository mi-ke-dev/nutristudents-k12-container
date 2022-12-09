<?php


namespace Bytelaunch\Nutristudents\Actions\HelpStates;

use Bytelaunch\Nutristudents\Models\HelpState;

class DeleteHelpStateAction
{

    private HelpState $helpstate;

    public function sourceHelpState(HelpState $helpstate) : self
    {
        $this->helpstate = $helpstate;
        return $this;
    }

    public function deleteHelpState()
    {
        $this->helpstate->delete();
    }

}
