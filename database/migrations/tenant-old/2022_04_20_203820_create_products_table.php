<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('distributor_id')->nullable();
            $table->string('name', 255);
            $table->string('manufacturer')->nullable();
            $table->string('manufacturer_sku')->nullable();
            $table->uuid('primary_category_id')->nullable();
            $table->uuid('primary_sub_category_id')->nullable();
            $table->float('case_weight')->nullable();
            $table->uuid('case_weight_uom_id')->nullable();
            $table->float('sub_case_weight')->nullable();
            $table->uuid('sub_case_weight_uom_id')->nullable();
            $table->float('case_volume')->nullable();
            $table->uuid('sub_case_volume_uom_id')->nullable();
            $table->integer('case_quantity')->nullable();
            $table->integer('sub_case_quantity')->nullable();
            $table->float('serving_measurement_weight')->nullable();
            $table->uuid('serving_measurement_weight_uom_id')->nullable();
            $table->float('serving_measurement_volume')->nullable();
            $table->uuid('serving_measurement_volume_uom_id')->nullable();
            $table->float('serving_measurement_unit')->nullable();
            $table->float('usda_componenent_serving_meat')->nullable();
            $table->float('usda_componenent_serving_grain')->nullable();
            $table->float('usda_componenent_serving_fruit')->nullable();
            $table->float('usda_componenent_serving_veg')->nullable();
            $table->float('usda_componenent_serving_vegleg')->nullable();
            $table->float('usda_componenent_serving_vegred')->nullable();
            $table->float('usda_componenent_serving_veggrn')->nullable();
            $table->float('usda_componenent_serving_vegstar')->nullable();
            $table->float('usda_componenent_serving_vegothr')->nullable();
            $table->float('nutrition_facts_weight')->nullable();
            $table->uuid('nutrition_facts_weight_uom_id')->nullable();
            $table->float('nutrition_facts_volume')->nullable();
            $table->uuid('nutrition_facts_uom_id')->nullable();
            $table->float('nutrition_facts_unit')->nullable();
            $table->float('nutrition_facts_calories')->nullable();
            $table->float('nutrition_facts_calfat')->nullable();
            $table->float('nutrition_facts_totalfat')->nullable();
            $table->float('nutrition_facts_satfat')->nullable();
            $table->float('nutrition_facts_transfat')->nullable();
            $table->float('nutrition_facts_polysatfat')->nullable();
            $table->float('nutrition_facts_monosatfat')->nullable();
            $table->float('nutrition_facts_cholesterol')->nullable();
            $table->float('nutrition_facts_sodium')->nullable();
            $table->float('nutrition_facts_potassium')->nullable();
            $table->float('nutrition_facts_carbs')->nullable();
            $table->float('nutrition_facts_fiber')->nullable();
            $table->float('nutrition_facts_sugar')->nullable();
            $table->float('nutrition_facts_protein')->nullable();
            $table->float('nutrition_facts_vitamina')->nullable();
            $table->float('nutrition_facts_vitaminb6')->nullable();
            $table->float('nutrition_facts_vitaminb12')->nullable();
            $table->float('nutrition_facts_vitaminc')->nullable();
            $table->float('nutrition_facts_vitamind')->nullable();
            $table->float('nutrition_facts_vitamine')->nullable();
            $table->float('nutrition_facts_calcium')->nullable();
            $table->float('nutrition_facts_iron')->nullable();
            $table->float('nutrition_facts_magnesium')->nullable();
            $table->float('nutrition_facts_coblamin')->nullable();
            $table->float('nutrition_facts_thiamin')->nullable();
            $table->float('nutrition_facts_riboflavin')->nullable();
            $table->float('nutrition_facts_niacin')->nullable();
            $table->float('nutrition_facts_zinc')->nullable();
            $table->float('nutrition_facts_water')->nullable();
            $table->float('nutrition_facts_ash')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->string('case_volume_uom_id')->nullable();
            $table->float('sub_case_volume')->nullable();
            $table->string('serving_measurement_unit_uom_id')->nullable();
            $table->string('nutrition_facts_volume_uom_id')->nullable();
            $table->string('nutrition_facts_unit_uom_id')->nullable();
            $table->float('usda_componenent_serving_milk')->nullable()->default(0);
            $table->string('cn_code')->nullable();
            $table->string('gtin')->nullable();
            $table->integer('yield')->nullable()->default(100);
            $table->string('gtin_number', 191)->nullable();
            $table->integer('pct_yield')->nullable();
            $table->integer('sort')->nullable();
            $table->boolean('is_commodity')->nullable();
            $table->boolean('is_kosher')->nullable();
            $table->boolean('can_use_for_ingredient')->nullable()->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
