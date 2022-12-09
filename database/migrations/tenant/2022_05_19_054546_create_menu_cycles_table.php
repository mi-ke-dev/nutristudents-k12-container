<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateMenuCyclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_cycles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->uuid('grade_range_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->uuid('meal_type_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('meal_type')->nullable();
            $table->uuid('age_grade_id')->nullable();
            $table->uuid('days_id')->nullable();
            $table->uuid('guideline_id')->nullable();
            $table->integer('week_number')->default(0);
            $table->boolean('is_template')->default(true);
            $table->uuid('source_id')->nullable();
            $table->uuid('group_source_id')->nullable();
        });
        // DB::statement('ALTER TABLE menu_cycles ALTER COLUMN id SET DEFAULT uuid_generate_v4();');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_cycles');
    }
}
