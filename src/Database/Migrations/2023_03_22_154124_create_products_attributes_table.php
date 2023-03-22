<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_attributes', function (Blueprint $table) {
            $table->bigIncrements('id',       )->length(10);
            $table->string('attr_name',       255);
            $table->string('attr_identifier', 255);
            $table->string('attr_descr' ,     255);
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->enum('attr_status', array('hidden', 'published'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products_attributes');
    }
}
