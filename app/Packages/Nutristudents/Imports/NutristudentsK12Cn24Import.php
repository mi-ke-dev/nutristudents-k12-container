<?php

namespace Bytelaunch\Nutristudents\Imports;

use Bytelaunch\Nutristudents\Imports\NutristudentsK12Cn24\FoodCategoriesImport;
use Bytelaunch\Nutristudents\Imports\NutristudentsK12Cn24\FoodDescriptionsImport;
use Bytelaunch\Nutristudents\Imports\NutristudentsK12Cn24\NutritionalValuesImport;
use Bytelaunch\Nutristudents\Imports\NutristudentsK12Setup\AllergensImport;
use Bytelaunch\Nutristudents\Imports\NutristudentsK12Setup\ComponentsImport;
use Bytelaunch\Nutristudents\Imports\NutristudentsK12Setup\GradeRangesImport;
use Bytelaunch\Nutristudents\Imports\NutristudentsK12Setup\GradesImport;
use Bytelaunch\Nutristudents\Imports\NutristudentsK12Setup\UnitOfMeasurementsImport;
use Bytelaunch\Nutristudents\Imports\NutristudentsK12Setup\CategoryImport;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class NutristudentsK12Cn24Import implements WithMultipleSheets
{

    public function sheets(): array
    {
        return [
            'Food Categories' => new FoodCategoriesImport(),
            'Food Descriptions' => new FoodDescriptionsImport(),
            'Nutritional Values' => new NutritionalValuesImport(),
        ];
    }


    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet was not found.
        info("Sheet {$sheetName} was skipped");
    }
}
