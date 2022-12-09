<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
class CreateCalendarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendars', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamps();
            $table->softDeletes();
            $table->date('month_year');
            $table->uuid('age_grade_offering_id');
            $table->uuid('meal_type_id');
            $table->uuid('day_id');
            $table->uuid('site_id')->nullable();
            $table->uuid('guide_line_id')->nullable();
            $table->string('site_type')->default('site');
            $table->uuid('group_id')->nullable();
            $table->uuid('offering_id')->nullable();
        });
        // DB::statement('ALTER TABLE calendars ALTER COLUMN id SET DEFAULT uuid_generate_v4();');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calendars');
    }
}
