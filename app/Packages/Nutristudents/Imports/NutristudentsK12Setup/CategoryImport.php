<?php

namespace Bytelaunch\Nutristudents\Imports\NutristudentsK12Setup;

use Bytelaunch\Nutristudents\Models\Category;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMapping;

class CategoryImport  implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $category = Category::firstOrCreate([
                    'name' => $row['category']
                ]);
        return new Category([
            'parent_id' => $category->id,
            'name' => $row['sub_category']
        ]);
    }
}
