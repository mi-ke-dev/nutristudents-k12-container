<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateIngredientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredients', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('ns_ingredient')->nullable();
            $table->string('name');
            $table->string('category')->nullable();
            $table->uuid('component_id')->nullable();
            $table->uuid('prefer_product_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        // DB::statement('ALTER TABLE ingredients ALTER COLUMN id SET DEFAULT uuid_generate_v4();');
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingredients');
    }
}
