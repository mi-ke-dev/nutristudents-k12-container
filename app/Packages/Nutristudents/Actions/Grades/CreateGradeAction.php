<?php


namespace Bytelaunch\Nutristudents\Actions\Grades;


use App\Models\User;
use Bytelaunch\Nutristudents\Models\Grade;
use Bytelaunch\Nutristudents\Models\Site;

class CreateGradeAction
{
    private string $name;
    private ?Site $site = null;

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function forSite(Site $site): self
    {
        $this->site = $site;
        return $this;
    }


    public function create(): Grade
    {
        $grade = Grade::create([
            'name' => $this->name,
        ]);

        if ($this->site) {
            $grade = (new AttachSiteAction())
                ->forGrade($grade)
                ->setSite($this->site)
                ->attach();
        }

        return $grade;
    }
}
