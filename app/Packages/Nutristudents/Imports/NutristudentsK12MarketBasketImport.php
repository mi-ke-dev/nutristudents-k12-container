<?php

namespace Bytelaunch\Nutristudents\Imports;

use Bytelaunch\Nutristudents\Imports\NutristudentsK12Cn24\FoodCategoriesImport;
use Bytelaunch\Nutristudents\Imports\NutristudentsK12Cn24\FoodDescriptionsImport;
use Bytelaunch\Nutristudents\Imports\NutristudentsK12Cn24\NutritionalValuesImport;
use Bytelaunch\Nutristudents\Imports\NutristudentsK12MarketBasket\IngredientImport;
use Bytelaunch\Nutristudents\Imports\NutristudentsK12MarketBasket\MarketBasketImport;
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

class NutristudentsK12MarketBasketImport implements WithMultipleSheets
{

    public function sheets(): array
    {
        return [
//            'Ingredient Table' => new IngredientImport(),
            'Market Basket' => new MarketBasketImport(),
        ];
    }


    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet was not found.
        info("Sheet {$sheetName} was skipped");
    }
}
