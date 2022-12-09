<?php


namespace Bytelaunch\Nutristudents\Actions\GradeRanges;


use App\Models\User;
use Bytelaunch\Nutristudents\Models\Grade;
use Bytelaunch\Nutristudents\Models\GradeRange;
use Bytelaunch\Nutristudents\Models\Site;

class CreateGradeRangeAction
{
    private string $name;
    private $grades = [];

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function attachGrade(Grade $grade): self
    {
        $this->grades[] = $grade;
        return $this;
    }


    public function create(): GradeRange
    {
        $gradeRange = GradeRange::create([
            'name' => $this->name,
        ]);

        $gradeRange->grades()->saveMany($this->grades);

        return $gradeRange;
    }
}
