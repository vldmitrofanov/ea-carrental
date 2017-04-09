<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRentalCarTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rental_car_types', function (Blueprint $table) {
            $table->integer('car_type_id')->unsigned();
            $table->integer('car_id')->unsigned();

            $table->foreign('car_type_id')->references('id')->on('car_types')
                ->onDelete('cascade');
            $table->foreign('car_id')->references('id')->on('rental_cars')
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
        Schema::drop('rental_car_types');
    }
}
