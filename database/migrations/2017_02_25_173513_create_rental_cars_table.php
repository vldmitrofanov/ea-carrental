<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRentalCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rental_cars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('registration_number');
            $table->string('current_mileage');
            $table->integer('type_id')->unsigned();
            $table->integer('model_id')->unsigned();
            $table->integer('location_id')->unsigned();
            $table->boolean('status')->default(1);
            $table->timestamps();

            $table->foreign('location_id')->references('id')->on('office_locations')
                    ->onDelete('cascade');
            $table->foreign('model_id')->references('id')->on('car_models')
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
        Schema::drop('rental_cars');
    }
}
