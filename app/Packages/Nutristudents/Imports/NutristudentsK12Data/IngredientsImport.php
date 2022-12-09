<?php

namespace Bytelaunch\Nutristudents\Imports\NutristudentsK12Data;

use Bytelaunch\Nutristudents\Models\Ingredient;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMapping;

class IngredientsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        if (!isset($row['description'])) {
            return;
        }
        return new Ingredient([
            'name' => $row['description'],
            'ns_ingredient' => $row['ns_ingredient'],
            'category' => $row['category'],
        ]);
    }
}
