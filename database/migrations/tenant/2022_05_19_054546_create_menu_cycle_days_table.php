<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateMenuCycleDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_cycle_days', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('menu_cycle_id');
            $table->enum('day_of_week', ['MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT', 'SUN']);
            $table->timestamps();
            $table->softDeletes();
            $table->uuid('group_source_id')->nullable();
        });
        // DB::statement('ALTER TABLE menu_cycle_days ALTER COLUMN id SET DEFAULT uuid_generate_v4();');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_cycle_days');
    }
}
