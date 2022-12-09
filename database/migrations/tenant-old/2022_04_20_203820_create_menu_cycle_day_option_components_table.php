<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuCycleDayOptionComponentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_cycle_day_option_components', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('menu_cycle_day_option_id')->nullable();
            $table->uuid('recipe_id');
            $table->text('cooking_instructions')->nullable();
            $table->json('exclude_from')->nullable();
            $table->boolean('smart_snack')->default(false);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->boolean('is_override')->default(false);
            $table->text('total_val_override')->nullable();
            $table->integer('student_count')->nullable();
            $table->uuid('source_id')->nullable();
            $table->boolean('is_exclude_export')->default(false);
            $table->boolean('is_exclude_from_printable_calendar')->default(false);
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
        Schema::dropIfExists('menu_cycle_day_option_components');
    }
}
