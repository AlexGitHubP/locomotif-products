<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsAreaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_areas', function (Blueprint $table) {
            $table->bigIncrements('id', )->length(10);
            $table->string       ('area_name', 255);
            $table->string       ('area_url' , 255);
            $table->integer      ('ordering' )->length(10)->unsigned()->nullable();
            $table->enum         ('status', array('hidden', 'published'));
            $table->dateTime     ('created_at');
            $table->dateTime     ('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products_areas');
    }
}
