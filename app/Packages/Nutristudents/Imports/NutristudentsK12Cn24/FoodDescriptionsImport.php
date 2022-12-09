<?php

namespace Bytelaunch\Nutristudents\Imports\NutristudentsK12Cn24;

use Bytelaunch\Nutristudents\Models\Category;
use Bytelaunch\Nutristudents\Models\Product;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMapping;

class FoodDescriptionsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {


        $categories = [
            '1' => 'Dairy and Egg Products',
            '2' => 'Spices and Herbs',
            '3' => 'Baby Foods',
            '4' => 'Fats and Oils',
            '5' => 'Poultry Products',
            '6' => 'Soups, Sauces, and Gravies',
            '7' => 'Sausages and Luncheon Meats',
            '8' => 'Breakfast Cereals',
            '9' => 'Fruits and Fruit Juices',
            '10' => 'Pork Products',
            '11' => 'Vegetables and Vegetable Products',
            '12' => 'Nut and Seed Products',
            '13' => 'Beef Products',
            '14' => 'Beverages',
            '15' => 'Finfish and Shellfish Products',
            '16' => 'Legumes and Legume Products',
            '17' => 'Lamb, Veal, and Game Products',
            '18' => 'Baked Products',
            '19' => 'Sweets',
            '20' => 'Cereal Grains and Pasta',
            '21' => 'Fast Foods',
            '22' => 'Meals, Entrees, and Side Dishes',
            '25' => 'Snacks',
            '35' => 'American Indian/Alaska Native Foods',
            '36' => 'Restaurant Foods',
        ];

        $category = Category::where('name', $categories[$row['food_category_code']])->firstOrFail();

        return new Product([
            'primary_category_id'  => $category->id,
            'primary_sub_category_id'  => $category->id,
            'manufacturer'  => $row['mfr_name'],
            'cn_code'  => $row['cn_code'],
            'name' => $row['descriptor'],
        ]);
    }
}
