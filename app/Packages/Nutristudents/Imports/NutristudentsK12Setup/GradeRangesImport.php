<?php

namespace Bytelaunch\Nutristudents\Imports\NutristudentsK12Setup;

use Bytelaunch\Nutristudents\Actions\GradeRanges\CreateGradeRangeAction;
use Bytelaunch\Nutristudents\Actions\Grades\CreateGradeAction;
use Bytelaunch\Nutristudents\Models\Allergen;
use Bytelaunch\Nutristudents\Models\Grade;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Row;

class GradeRangesImport implements OnEachRow, WithHeadingRow
{
    public function onRow(Row $row)
    {
        $row = $row->toArray();

        $gradeRange = (new CreateGradeRangeAction())
            ->setName($row['name']);

        foreach (explode(',', $row['grades']) as $grade) {
            $grade = Grade::where('name', $grade)->firstOrFail();
            $gradeRange = $gradeRange->attachGrade($grade);
        }

        $gradeRange = $gradeRange->create();

        return $gradeRange;

    }
}
