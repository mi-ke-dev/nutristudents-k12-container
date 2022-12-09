<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngredientRecipeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredient_recipe', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->uuid('ingredient_id');
            $table->uuid('recipe_id');
            $table->timestamps();
            $table->softDeletes();
            $table->float('recipe_amount')->default(0);
            $table->uuid('recipe_amount_uom_id')->nullable();
            $table->float('usda_componenent_meat')->nullable();
            $table->float('usda_componenent_grain')->nullable();
            $table->float('usda_componenent_fruit')->nullable();
            $table->float('usda_componenent_milk')->nullable();
            $table->float('usda_componenent_veg')->nullable();
            $table->float('serving_amount')->default(0);
            $table->uuid('serving_amount_uom_id')->nullable();
            $table->float('usda_componenent_veggrn')->nullable();
            $table->float('usda_componenent_vegred')->nullable();
            $table->float('usda_componenent_vegleg')->nullable();
            $table->float('usda_componenent_vegstar')->nullable();
            $table->float('usda_componenent_vegothr')->nullable();
            $table->float('usda_componenent_meat_override')->nullable();
            $table->float('usda_componenent_grain_override')->nullable();
            $table->float('usda_componenent_fruit_override')->nullable();
            $table->float('usda_componenent_milk_override')->nullable();
            $table->float('usda_componenent_veg_override')->nullable();
            $table->float('usda_componenent_veggrn_override')->nullable();
            $table->float('usda_componenent_vegred_override')->nullable();
            $table->float('usda_componenent_vegleg_override')->nullable();
            $table->float('usda_componenent_vegstar_override')->nullable();
            $table->float('usda_componenent_vegothr_override')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingredient_recipe');
    }
}
