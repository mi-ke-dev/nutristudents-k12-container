<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_user', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->uuid('site_id');
            $table->integer('user_id');
            $table->boolean('can_view')->default(true);
            $table->boolean('can_admin')->default(false);
            $table->boolean('can_menu_edit')->default(false);
            $table->boolean('can_order_edit')->default(false);
            $table->boolean('can_add_student_counts')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('site_user');
    }
}
