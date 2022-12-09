<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->string('modelable_type');
            $table->uuid('modelable_id');
            $table->string('permissionable_type');
            $table->uuid('permissionable_id');
            $table->boolean('is_admin')->default(false);
            $table->boolean('menu_edit')->default(false);
            $table->boolean('order_edit')->default(false);
            $table->boolean('student_counts')->default(false);
            $table->boolean('view')->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['permissionable_type', 'permissionable_id']);
            $table->index(['modelable_type', 'modelable_id']);
        });
        // DB::statement('ALTER TABLE permissions ALTER COLUMN id SET DEFAULT uuid_generate_v4();');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
    }
}
