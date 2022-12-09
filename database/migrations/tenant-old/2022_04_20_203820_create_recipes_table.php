<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('ns_recipe')->nullable();
            $table->string('category');
            $table->integer('portion');
            $table->float('serving_size');
            $table->text('cooking_instructions')->nullable();
            $table->string('photo_store_path')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->uuid('haccp_id')->nullable();
            $table->uuid('portion_uom_id')->nullable();
            $table->uuid('serving_size_uom_id')->nullable();
            $table->boolean('is_favorite')->default(false);
            $table->string('simplified_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipes');
    }
}
