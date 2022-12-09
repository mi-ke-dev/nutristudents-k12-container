<?php

namespace Bytelaunch\Nutristudents\Imports\NutristudentsK12Setup;

use Bytelaunch\Nutristudents\Models\Allergen;
use Bytelaunch\Nutristudents\Models\UnitOfMeasurement;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMapping;

class UnitOfMeasurementsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new UnitOfMeasurement([
            'name' => $row['name'],
            'type' => $row['type'],
        ]);
    }
}
