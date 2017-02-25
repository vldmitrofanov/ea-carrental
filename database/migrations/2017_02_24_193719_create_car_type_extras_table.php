<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarTypeExtrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_type_extras', function (Blueprint $table) {
            $table->integer('car_type_id')->unsigned();
            $table->integer('car_extras_id')->unsigned();

            $table->foreign('car_type_id')->references('id')->on('car_types')
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
        Schema::drop('car_type_extras');
    }
}
