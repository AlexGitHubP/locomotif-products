<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id',         )->length(10);
            $table->string('name',           255);
            $table->string('url' ,           255);
            $table->integer('designer_id'       )->length(10)->index()->unsigned();
            $table->string('product_type',   255); // designer/simple/etc
            $table->string('sku',            255)->nullable();
            $table->string('stock',          255)->nullable();
            $table->string('price',          255)->nullable();
            $table->string('price_estimate', 255)->nullable();
            $table->text('description',      255);
            $table->string('rand_3d',        255)->nullable();
            $table->integer('ordering'          )->length(10)->unsigned()->nullable();
            $table->string('favourite_product', 255)->nullable();
            $table->enum('product_status', array('pending', 'hidden', 'published'));
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
