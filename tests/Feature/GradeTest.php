<?php

namespace Bytelaunch\Nutristudents\Tests\Feature;

use Bytelaunch\Nutristudents\Actions\GradeRanges\CreateGradeRangeAction;
use Bytelaunch\Nutristudents\Actions\Grades\CreateGradeAction;
use Bytelaunch\Nutristudents\Actions\Groups\AttachSiteAction;
use Bytelaunch\Nutristudents\Actions\Groups\DetachSiteAction;
use Bytelaunch\Nutristudents\Models\Group;
use Bytelaunch\Nutristudents\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

class GradeTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }


    /**
     * @test
     */
    public function a_grade_can_be_created(): void
    {
        $this->assertNotNull($this->gradeK->id);
    }

    /**
     * @test
     */
    public function a_grade_range_can_be_created(): void
    {
        $grade3 = (new CreateGradeAction())
            ->setName('3')
            ->create();
        $grade4 = (new CreateGradeAction())
            ->setName('4')
            ->create();
        $grade5 = (new CreateGradeAction())
            ->setName('5')
            ->create();

        $gradeRange = (new CreateGradeRangeAction())
            ->setName('3 to 5')
            ->attachGrade($grade3)
            ->attachGrade($grade4)
            ->attachGrade($grade5)
            ->create();

        $this->assertCount(3, $gradeRange->with('grades')->first()->grades);


    }

}
