<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecialoffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specialoffers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('discountvalue')->unsigned();
            $table->string('title',256);
            $table->text('description');
            $table->string('link');
            $table->string('urlimage');
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
        Schema::dropIfExists('specialoffers');
    }
}
