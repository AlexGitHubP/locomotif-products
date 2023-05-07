<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_categories', function (Blueprint $table) {
            $table->bigIncrements('id', )->length(10);
            $table->string       ('category_name', 255);
            $table->string       ('category_url' , 255);
            $table->text         ('category_description', 255);
            $table->integer      ('ordering' )->length(10)->unsigned()->nullable();
            $table->enum         ('category_status', array('hidden', 'published'));
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
        Schema::dropIfExists('products_categories');
    }
}
