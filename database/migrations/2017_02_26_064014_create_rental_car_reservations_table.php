<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRentalCarReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rental_car_reservations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('reservation_number');
            $table->dateTime('date_from');
            $table->dateTime('date_to');
            $table->integer('car_type_id')->unsigned();
            $table->integer('car_id')->unsigned();
            $table->integer('pickup_location_id')->unsigned();
            $table->integer('return_location_id')->unsigned();
            $table->string('pickup_near_location');
            $table->string('return_near_location');
            $table->string('ip_address');
            $table->integer('user_id')->unsigned();
            $table->dateTime('pickup_date');
            $table->integer('pickup_mileage')->default(0);
            $table->dateTime('return_date');
            $table->integer('return_mileage')->default(0);

            $table->enum('status', ['pending', 'confirmed', 'cancelled', 'collected', 'completed'])->default('pending');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('car_id')->references('id')->on('rental_cars')->onDelete('cascade');
            $table->foreign('car_type_id')->references('id')->on('car_types')->onDelete('cascade');
//            $table->foreign('pickup_location_id')->references('id')->on('office_locations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('rental_car_reservations');
    }
}
