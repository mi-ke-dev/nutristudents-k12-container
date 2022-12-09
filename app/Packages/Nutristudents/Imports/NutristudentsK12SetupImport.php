<?php

namespace Bytelaunch\Nutristudents\Imports;

use Bytelaunch\Nutristudents\Imports\NutristudentsK12Data\IngredientsImport;
use Bytelaunch\Nutristudents\Imports\NutristudentsK12Data\RecipesImport;
use Bytelaunch\Nutristudents\Imports\NutristudentsK12Data\WeekCyclesImport;
use Bytelaunch\Nutristudents\Imports\NutristudentsK12Setup\AllergensImport;
use Bytelaunch\Nutristudents\Imports\NutristudentsK12Setup\ComponentsImport;
use Bytelaunch\Nutristudents\Imports\NutristudentsK12Setup\UnitOfMeasurementsImport;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class NutristudentsK12SetupImport implements WithMultipleSheets
{

    public function sheets(): array
    {
        return [
            'Ingredients' => new IngredientsImport(),
            'Recipes' => new RecipesImport(),
            'Week Cycles' => new WeekCyclesImport(),
        ];
    }


    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet was not found.
        info("Sheet {$sheetName} was skipped");
    }


}
