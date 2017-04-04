<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarModelExtrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_model_extras', function (Blueprint $table) {
            $table->integer('model_id_id')->unsigned();
            $table->integer('car_extras_id')->unsigned();

            $table->foreign('model_id_id')->references('id')->on('car_models')
                ->onDelete('cascade');
            $table->foreign('car_extras_id')->references('id')->on('car_extras')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('car_model_extras');
    }
}
