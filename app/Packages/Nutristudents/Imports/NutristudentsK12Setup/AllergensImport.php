<?php

namespace Bytelaunch\Nutristudents\Imports\NutristudentsK12Setup;

use Bytelaunch\Nutristudents\Models\Allergen;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMapping;

class AllergensImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Allergen([
            'name' => $row['name'],
        ]);
    }
}
