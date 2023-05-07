<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsAttributesValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_attributes_values', function (Blueprint $table) {
            $table->bigIncrements('id',                )->length(10);
            $table->integer('attr_id',                 )->length(10)->index();
            $table->string('attr_value_name',       255);
            $table->string('attr_value_identifier', 255);
            $table->string('attr_value',            255);
            $table->timestamps();
            $table->enum('attr_value_status', array('hidden', 'published'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products_attributes_values');
    }
}
