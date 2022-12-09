<?php


namespace Bytelaunch\Nutristudents\Actions\Grades;


use App\Models\User;
use Bytelaunch\Nutristudents\Models\Grade;
use Bytelaunch\Nutristudents\Models\Site;

class AttachSiteAction
{
    private Grade $grade;
    private Site $site;

    public function forGrade(Grade $grade): self
    {
        $this->grade = $grade;
        return $this;
    }

    public function setSite(Site $site): self
    {
        $this->site = $site;
        return $this;
    }



    public function attach(): Grade
    {
        $this->site->grades()->save($this->grade);

        return $this->grade;
    }
}
