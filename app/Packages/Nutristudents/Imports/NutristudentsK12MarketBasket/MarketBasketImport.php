<?php

namespace Bytelaunch\Nutristudents\Imports\NutristudentsK12MarketBasket;

use Bytelaunch\Nutristudents\Actions\Products\CreateProductAction;
use Bytelaunch\Nutristudents\Actions\Recipes\CreateRecipeAction;
use Bytelaunch\Nutristudents\Models\Category;
use Bytelaunch\Nutristudents\Models\Ingredient;
use Bytelaunch\Nutristudents\Models\Product;
use Bytelaunch\Nutristudents\Models\UnitOfMeasurement;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Row;

class MarketBasketImport implements OnEachRow, WithHeadingRow
{

    public function onRow(Row $row)
    {
        $row = $row->toArray();

        if ($row['product_name'] == "") {
            return;
        }

        $category_id = $this->determineCategory($row['category']);
        $sub_category_id = $this->determineSubCategory($category_id, $row['sub_category']);
//        return ;

        $case_weight_uom_id = $this->determineUOM($row['case_weight_measure']);
        $case_volume_uom_id = $this->determineUOM($row['case_volume_measure']);
        $sub_case_weight_uom_id = $this->determineUOM($row['sub_case_weight_measure']);
        $sub_case_volume_uom_id = $this->determineUOM($row['sub_case_volume_measure']);
        $serving_measurement_volume_uom_id = $this->determineUOM($row['serving_volume_measure']);
        $serving_measurement_unit_uom_id = $this->determineUOM($row['serving_units_measure']);
        $serving_measurement_weight_uom_id = $this->determineUOM($row['serving_weight_measure']);


//        echo "👉 {$row['product_name']} ...";
//
        /////////////////////////
//        $product = Product::where('name', $row['product_name'])->firstOrFail();
        $ingredient_name = $row['ingredient'];
        $ingredient = Ingredient::where('name', 'ilike', $ingredient_name)->first();
        if (!$ingredient) {

            $ingredient = Ingredient::forceCreate([
                'name' => $ingredient_name
            ]);
        }
//
//        if (!$ingredient) return;
//        echo "\n" . 'INSERT INTO "public"."ingredient_product"( "ingredient_id", "product_id") VALUES (\'' . $ingredient->id . '\', \'' . $product->id . '\');';
//        return;
//        exit;


        /////////////////////////

        $product = new Product();
        $product->forceFill([
//            'distributor_id' => $row[''],
            'name' => $row['product_name'],
            'manufacturer' => $row['manufacturer'],
            'manufacturer_sku' => $row['manufacturer_num'],
            'primary_category_id' => $category_id, // category
            'primary_sub_category_id' => $sub_category_id, // sub_category
            'gtin_number' => $row['gtin_number'],

            'case_weight' => $row['case_weight'],
            'case_weight_uom_id' => $case_weight_uom_id, // case_weight_measure

            'sub_case_weight' => $row['sub_case_weight'],
            'sub_case_weight_uom_id' => $sub_case_weight_uom_id, // sub_case_weight_measure
            'case_volume' => $row['case_volume'],
            'case_volume_uom_id' => $case_volume_uom_id, // case_volume_measure

            'sub_case_volume' => $row['sub_case_volume'],
            'sub_case_volume_uom_id' => $sub_case_volume_uom_id, // case_volume_measure

            // case_volume_measure
            // sub_case_volume
            'case_quantity' => $this->qty($row['case_qty']),
            'sub_case_quantity' => $this->qty($row['sub_case_qty']),
            // yield
            'serving_measurement_weight' => $this->serving($row['serving_weight']),
            'serving_measurement_weight_uom_id' => $serving_measurement_weight_uom_id, // serving_weight_measure
            'serving_measurement_volume' => $this->serving($row['serving_volume']),
            'serving_measurement_volume_uom_id' => $serving_measurement_volume_uom_id, // serving_volume_measure

            'serving_measurement_unit' => $this->serving($row['serving_units']),
            'serving_measurement_unit_uom_id' => $serving_measurement_unit_uom_id,

            'usda_componenent_serving_meat' => $this->serving($row['meatmeat_alternate']),
            'usda_componenent_serving_grain' => $this->serving($row['whole_grain_rich_equiv']),
            'usda_componenent_serving_fruit' => $this->serving($row['fruit']),
            'usda_componenent_serving_veg' => $this->serving($row['vegetable']),
            'usda_componenent_serving_vegleg' => $this->serving($row['veg_legume']),
            'usda_componenent_serving_vegred' => $this->serving($row['veg_redorange']),
            'usda_componenent_serving_veggrn' => $this->serving($row['veg_dark_green']),
            'usda_componenent_serving_vegstar' => $this->serving($row['veg_starchy']),
            'usda_componenent_serving_vegothr' => $this->serving($row['veg_other']),
            'usda_componenent_serving_milk' => $this->serving($row['milk']),

//            'nutrition_facts_weight' => $row[''],
//            'nutrition_facts_weight_uom_id' => $row[''],
//            'nutrition_facts_volume' => $row[''],
//            'nutrition_facts_uom_id' => $row[''],
//            'nutrition_facts_unit' => $row[''],
            'nutrition_facts_calories' => $row['calories_kcal'],
            'nutrition_facts_calfat' => $row['caloriesfat_kcal'],
            'nutrition_facts_totalfat' => $row['total_fatg'],
            'nutrition_facts_satfat' => $this->gVal($row['saturated_fat_g']),
            'nutrition_facts_transfat' => $this->gVal($row['trans_fat_g']),
            'nutrition_facts_polysatfat' => $this->gVal($row['polysat_fat_g']),
            'nutrition_facts_monosatfat' => $this->gVal($row['monosat_fat_g']),
            'nutrition_facts_cholesterol' => $this->gVal($row['cholesterol_mg']),
            'nutrition_facts_sodium' => $this->gVal($row['sodiummg']),
            'nutrition_facts_potassium' => $this->gVal($row['potassium_mg']),
            'nutrition_facts_carbs' => $this->gVal($row['carbs_g']),
            'nutrition_facts_fiber' => $this->gVal($row['fiber_g']),
            'nutrition_facts_sugar' => $this->gVal($row['sugar_g']),
            'nutrition_facts_protein' => $this->gVal($row['protein_g']),
            'nutrition_facts_vitamina' => $this->pctVal($row['vitamin_a_daily']),
            'nutrition_facts_vitaminb6' => $this->pctVal($row['vitamin_b_daily']),
            'nutrition_facts_vitaminb12' => $this->pctVal($row['vitamin_b12_daily']),
            'nutrition_facts_vitaminc' => $this->pctVal($row['vitamin_c_daily']),
            'nutrition_facts_vitamind' => $this->pctVal($row['vitamin_d_daily']),
            'nutrition_facts_vitamine' => $this->pctVal($row['vitamin_e_daily']),
            'nutrition_facts_calcium' => $this->pctVal($row['calcium_daily']),
            'nutrition_facts_iron' => $this->gVal($row['iron_mg']),
            'nutrition_facts_magnesium' => $this->gVal($row['magnesium_mg']),
            'nutrition_facts_coblamin' => $this->gVal($row['coblamin_mg']),
            'nutrition_facts_thiamin' => $this->gVal($row['thamin_mg']),
            'nutrition_facts_riboflavin' => $this->gVal($row['riboflavin_mg']),
            'nutrition_facts_niacin' => $this->gVal($row['nacin_mg']),
            'nutrition_facts_zinc' => $this->gVal($row['zinc_mg']),
            'nutrition_facts_water' => $this->gVal($row['water_g']),
            'nutrition_facts_ash' => $this->gVal($row['ash_g']),
//            'created_at' => $row[''],
//            'updated_at' => $row[''],
//            'deleted_at' => $row[''],
//            'case_volume_uom_id' => $row[''],
//            'sub_case_volume' => $row[''],
//            'nutrition_facts_volume_uom_id' => $row[''],
//            'nutrition_facts_unit_uom_id' => $row[''],
//            'usda_componenent_serving_milk' => $row[''],
//            'cn_code' => $row[''],

            //    [allergens_corn] =>
            //    [allergens_egg] =>
            //    [allergens_fish] =>
            //    [allergens_meat] =>
            //    [allergens_milk] =>
            //    [allergens_peanut] =>
            //    [allergens_shellfish] =>
            //    [allergens_soy] =>
            //    [allergens_treenut] =>
            //    [allergens_wheat] =>

            'is_commodity' => $row['commodity_yn'] == "Y",
            'is_kosher' => $row['kosher'] != "",
            'sort' => $row['sort'],
            'can_use_for_ingredient' => true,
            // kosher
        ]);
        $product->save();

        $ingredient_product = DB::table('ingredient_product')
            ->where('ingredient_id', $ingredient->id)
            ->where('product_id', $product->id)
            ->first();

        if (!$ingredient_product) {
            echo "Adding Ingredient... ";

            $ingredient_product = DB::table('ingredient_product')
                ->insert([
                    'ingredient_id' => $ingredient->id,
                    'product_id' => $product->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
        }

    }
//    public function model(array $row)
//    {
//        print_r($row); exit;
//        return new Ingredient([
//            'name' => $row['name'],
//        ]);
//    }

    public function determineUOM($item)
    {
        $item = trim(strtolower($item));
        $item = str_replace("(s)", "", $item);
        $item = str_replace(".", "", $item);

//        echo " Looking for {$item} ...";

        if ($item == "") return null;

        $item = $item == "lbs" ? "LB" : $item;
        $item = $item == "oz" ? "Ounce" : $item; // oz when weight, fl oz when volume
        $item = $item == "fl oz" ? "Fluid Ounce" : $item;
        $item = $item == "grams" ? "Gram" : $item;
        $item = $item == "slice" ? "Piece" : $item;
        $item = $item == "tsp" ? "Teaspoon" : $item;
        $item = $item == "tbsp" ? "Tablespoon" : $item;
        $item = $item == "gal" ? "Gallon" : $item;

        try {
            $uom = UnitOfMeasurement::where('name', 'ilike', $item)->firstOrFail('id');
        } catch (\Exception $e) {
            echo $e->getMessage();
            exit;
        }

        return $uom->id;
    }

    public function determineCategory($categoryName)
    {

//        echo "Looking for $category ...";

        $categoryNameLower = trim(strtolower($categoryName));

        if ($categoryNameLower == "tbd") return null;

        $category = Category::where('name', 'ilike', $categoryNameLower)->first('id');

        if (!$category) {
            echo " ... creating CAT: $categoryName ...";
            $category = Category::forceCreate([
                'parent_id' => null,
                'name' => $categoryName
            ]);
        }

        return $category->id;
    }

    public function determineSubCategory($categoryId, $subCategory)
    {

//        echo "Looking for $subCategory ...";
        $subCategory = trim($subCategory);

        if ($subCategory == "") return null;

        $category = Category::where('parent_id', $categoryId)
            ->where('name', 'ilike', $subCategory)
            ->first();

        if (!$category) {
            echo " ... creating SC $subCategory ...";
            $category = Category::forceCreate([
                'parent_id' => $categoryId,
                'name' => $subCategory
            ]);
        }

        return $category->id;

    }

    public function pctVal($input)
    {
        if ($input == "") return null;

        return preg_replace("/[^0-9\.]/", "", $input);
    }

    public function gVal($input)
    {
        if ($input == "<1") return 0.9;
        if ($input == "<5") return 4.9;

        // 70MG"
        $input = preg_replace("/[^0-9\.]/", "", $input);


        if ($input == "") return null;

        return $input;

    }

    public function qty($input)
    {

        if ($input == "") return null;

        return ceil($input);
    }

    public function serving($input)
    {

        if ($input == "") return null;

        // 39G
        // 7/16
        return preg_replace("/[^0-9\.]/", "", $input);
    }
}
