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

class GradesImport implements OnEachRow, WithHeadingRow
{
    public function onRow(Row $row)
    {

        return (new CreateGradeAction())
            ->setName($row['name'])
            ->create();
    }
}
