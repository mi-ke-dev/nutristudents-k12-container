<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveFieldsInOfferingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('offerings', function (Blueprint $table) {
            $table->dropColumn(['menu_adminable_type', 'menu_adminable_id', 'order_adminable_type', 'order_adminable_id', 'prep_site_id', 'cook_site_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('offerings', function (Blueprint $table) {
            //
        });
    }
}
