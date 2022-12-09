<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAssemblyServingFreeTextToMenuCycleDayOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('menu_cycle_day_options', 'assembly_serving_free_text')){
            Schema::table('menu_cycle_day_options', function (Blueprint $table) {
                $table->string('assembly_serving_free_text')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('menu_cycle_day_options', function (Blueprint $table) {
            //
        });
    }
}
