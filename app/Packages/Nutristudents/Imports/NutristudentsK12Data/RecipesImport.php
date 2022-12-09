<?php

namespace Bytelaunch\Nutristudents\Imports\NutristudentsK12Data;

use Bytelaunch\Nutristudents\Actions\Recipes\CreateRecipeAction;
use Bytelaunch\Nutristudents\Models\Ingredient;
use Bytelaunch\Nutristudents\Models\UnitOfMeasurement;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Row;

class RecipesImport implements OnEachRow, WithHeadingRow
{

    public function onRow(Row $row)
    {
        $row = $row->toArray();

        if ($row['recipe_description'] == "") {
            return;
        }

        $recipe = (new CreateRecipeAction())
            ->setName($row['recipe_description'])
            ->setRecipeNum($row['recipe'])
            ->setCategory('Entree')
            ->setRecipePortion((int)$row['of_portions'])
            ->setServingSize((int)$row['portion_size'])
            ->setCookingInstructions($row['cooking_instructions']);

        echo $row['recipe'] . "\n";

        print_r($row);

        for ($i = 1; $i <= 48; $i++) {

            echo "\n #### $i";

            $ing = ($i == 1) ? $row['ing'] : $row['ing_' . $i];
            $amtIng = ($i == 1) ? $row['amt_ing'] : $row['amt_ing_' . $i];
            $measIng = ($i == 1) ? $row['meas_ing'] : $row['meas_ing_' . $i];

            if ($measIng == "EACH") {
                $measIng = "Ea";
            }

            if ($amtIng == "*" || $measIng == "*") {
                echo "\n skipping Ingredient $ing ... \n";
                continue;
            }

            if ($ing != '') {
                echo $ing. " ";

                $ingredient = Ingredient::where('ns_ingredient', $ing)->first();

                if (!$ingredient) {
                    echo "\n Ingredient $ing not found. Skipping ... \n";
                    continue;
                }
                $recipe = $recipe->addIngredient($ingredient, $amtIng, call_user_func('Bytelaunch\Nutristudents\Models\UnitOfMeasurement::' . $measIng), []);
            }
        }

        $recipe = $recipe->create();
    }
//    public function model(array $row)
//    {
//        print_r($row); exit;
//        return new Ingredient([
//            'name' => $row['name'],
//        ]);
//    }
}
