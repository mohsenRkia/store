<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('discount_id')->unsigned();
            $table->string('name',256);
            $table->string('productcode',35);
            $table->text('description');
            $table->string('slug');
            $table->integer('productquantity')->unsigned();
            $table->decimal('offerprice',8,2)->nullable();
            $table->decimal('weight',4,2)->nullable();
            $table->boolean('salable')->default(1);
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
        Schema::dropIfExists('products');
    }
}
