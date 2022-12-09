<?php

namespace Bytelaunch\Nutristudents\Imports\NutristudentsK12Cn24;

use Bytelaunch\Nutristudents\Models\Category;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMapping;

class FoodCategoriesImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Category([
            'name' => $row['category_description'],
            'parent_id' => null,
        ]);
    }
}
