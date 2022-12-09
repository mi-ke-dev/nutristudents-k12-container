<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuCycleDayOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_cycle_day_options', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('menu_cycle_day_id');
            $table->string('photo_store_path');
            $table->integer('sort_order');
            $table->timestamps();
            $table->softDeletes();
            $table->string('name')->nullable();
            $table->boolean('is_favorite')->default(false);
            $table->float('assembly_serving')->nullable();
            $table->text('assembly_instructions')->nullable();
            $table->boolean('is_exclude_from_export')->default(false);
            $table->uuid('assembly_serving_unit')->nullable();
            $table->boolean('a_la_carte')->default(false);
            $table->uuid('group_source_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_cycle_day_options');
    }
}
