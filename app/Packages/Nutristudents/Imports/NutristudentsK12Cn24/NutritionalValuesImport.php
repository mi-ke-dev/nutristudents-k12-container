<?php

namespace Bytelaunch\Nutristudents\Imports\NutristudentsK12Cn24;

use Bytelaunch\Nutristudents\Models\Product;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;

class NutritionalValuesImport implements OnEachRow, WithHeadingRow
{


    public function onRow(Row $row)
    {

        $nutrients = [
            '203' => 'nutrition_facts_protein',
            '204' => 'nutrition_facts_totalfat',
            '205' => 'nutrition_facts_carbs',
            '207' => 'nutrition_facts_ash',
            '208' => 'nutrition_facts_calories',
            '255' => 'nutrition_facts_water',
            '269' => 'nutrition_facts_sugar',
            '291' => 'nutrition_facts_fiber',
            '301' => 'nutrition_facts_calcium',
            '303' => 'nutrition_facts_iron',
            '306' => 'nutrition_facts_potassium',
            '307' => 'nutrition_facts_sodium',
            '318' => 'nutrition_facts_vitamina',
            '328' => 'nutrition_facts_vitamind',
            '401' => 'nutrition_facts_vitaminc',
            '601' => 'nutrition_facts_cholesterol',
            '605' => 'nutrition_facts_transfat',
            '606' => 'nutrition_facts_satfat',
        ];
        $row = $row->toArray();

        $columnName = $nutrients[$row['nutrient_code']];

        $product = Product::where('cn_code', $row['cn_code'])->firstOrFail();

        echo "{$product->cn_code} {$product->name} \n";

        $product->{$columnName} = floatval($row['nutrient_value']);
        $product->save();

    }
}
