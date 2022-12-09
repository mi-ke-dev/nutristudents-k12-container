<?php

namespace Bytelaunch\Nutristudents\Actions\HelpStates;


use Bytelaunch\Nutristudents\Models\HelpState;

class UpdateHelpStateAction
{    

    private HelpState $helpstate;

    public function setHelpState(HelpState $helpstate): self
    {
        $this->helpstate = $helpstate;
        return $this;
    }

    public function setName(string $name) : self
    {
        $this->helpstate->name = $name;
        return $this;
    }

    public function setPage(string $page) : self
    {
        $this->helpstate->page_url = $page;
        return $this;
    }    

    public function setYoutubeID(string $youtubeID = null) : self
    {
        $this->helpstate->youtube_id = $youtubeID;
        return $this;
    }

    public function setContent(string $content = null) : self
    {
        $this->helpstate->content = $content;
        return $this;
    }

    

    public function update() : HelpState
    {
        $this->helpstate->save();           

        return $this->helpstate;
    }




}
