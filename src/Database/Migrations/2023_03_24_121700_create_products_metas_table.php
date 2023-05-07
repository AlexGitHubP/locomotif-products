<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsMetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_metas', function (Blueprint $table) {
            $table->bigIncrements('id'             )->length(10);
            $table->integer('pid',                 )->length(10)->index();
            $table->string('meta_name',         255);
            $table->string('meta_owner',        255);
            $table->string('meta_key',          255)->index();
            $table->string('meta_attribute',    255)->index();
            $table->string('meta_combined_key', 255);
            $table->string('meta_value',        255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products_metas');
    }
}
