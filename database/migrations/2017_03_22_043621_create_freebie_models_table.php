<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFreebieModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount_freebie_models', function (Blueprint $table) {
            $table->integer('discount_freebies_id')->unsigned();
            $table->integer('model_id')->unsigned();

            $table->foreign('discount_freebies_id')->references('id')->on('discount_freebies')->onDelete('cascade');
            $table->foreign('model_id')->references('id')->on('car_models')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('discount_freebie_models');
    }
}
