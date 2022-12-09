<?php

namespace Bytelaunch\Nutristudents\Imports\NutristudentsK12MarketBasket;

use Bytelaunch\Nutristudents\Actions\Recipes\CreateRecipeAction;
use Bytelaunch\Nutristudents\Models\Ingredient;
use Bytelaunch\Nutristudents\Models\Product;
use Bytelaunch\Nutristudents\Models\UnitOfMeasurement;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Row;

class IngredientImport implements OnEachRow, WithHeadingRow
{

    public function onRow(Row $row)
    {
        Ingredient::forceCreate([
            'name' => $row['ingredient_names']
        ]);
    }

}
