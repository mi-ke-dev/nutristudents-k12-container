<?php

namespace Bytelaunch\Nutristudents\Actions\HelpStates;


use Bytelaunch\Nutristudents\Models\HelpState;

class CreateHelpStateAction
{

    private string $name;
    private string $page;
    private ?string $youtube = null;
    private ?string $content = null;

    public function setName(string $name) : self
    {
        $this->name = $name;
        return $this;
    }

    public function setPage(string $page) : self
    {
        $this->page = $page;
        return $this;
    }    

    public function setYoutubeID(string $youtubeID = null) : self
    {
        $this->youtube = $youtubeID;
        return $this;
    }

    public function setContent(string $content = null) : self
    {
        $this->content = $content;
        return $this;
    }

    

    public function create() : HelpState
    {
        $HelpState = HelpState::create([
            'name' => $this->name,
            'page_url' => $this->page,
            'youtube_id' => $this->youtube,
            'content' => $this->content,
        ]);        

        return $HelpState;
    }




}
