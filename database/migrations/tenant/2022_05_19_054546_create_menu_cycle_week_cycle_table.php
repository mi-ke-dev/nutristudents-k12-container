<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateMenuCycleWeekCycleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_cycle_week_cycle', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('week_cycle_id');
            $table->uuid('menu_cycle_id');
            $table->integer('sort_order');
            $table->timestamps();
            $table->softDeletes();
        });
        // DB::statement('ALTER TABLE menu_cycle_week_cycle ALTER COLUMN id SET DEFAULT uuid_generate_v4();');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_cycle_week_cycle');
    }
}
