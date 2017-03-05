<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarReservationDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::drop('car_reservation_details');
        Schema::create('car_reservation_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('reservation_id')->unsigned();
            $table->integer('car_type_id')->unsigned();
            $table->integer('car_id')->unsigned();
            $table->dateTime('date_from');
            $table->dateTime('date_to');
            $table->integer('pickup_location_id')->unsigned();
            $table->integer('return_location_id')->unsigned();
            $table->string('pickup_near_location')->default('');
            $table->string('return_near_location')->default('');
            $table->dateTime('pickup_date')->nullable();
            $table->integer('pickup_mileage')->default(0);
            $table->dateTime('return_date')->nullable();
            $table->integer('return_mileage')->default(0);

            $table->integer('start')->default(0);
            $table->integer('end')->default(0);
            $table->integer('rental_days')->default(0);
            $table->integer('rental_hours')->default(0);
            $table->decimal('price_per_day', 10, 2)->default(0);
            $table->string('price_per_day_detail')->default('');
            $table->decimal('price_per_hour',10,2)->default(0);
            $table->string('price_per_hour_detail')->default('');
            $table->decimal('car_rental_fee',10,2)->default(0);
            $table->decimal('extra_price',10,2)->default(0);
            $table->decimal('insurance',10,2)->default(0);
            $table->decimal('sub_total',10,2)->default(0);
            $table->decimal('tax',10,2)->default(0);
            $table->decimal('total_price',10,2)->default(0);
            $table->decimal('required_deposit',10,2)->default(0);
            $table->dateTime('actual_dropoff_datetime')->nullable();
            $table->integer('dropoff_mileage')->default(0);
            $table->integer('security_deposit')->default(0);
            $table->timestamps();

            $table->foreign('reservation_id')->references('id')->on('rental_car_reservations')->onDelete('cascade');
//            $table->foreign('car_id')->references('id')->on('rental_cars')->onDelete('cascade');
//            $table->foreign('car_type_id')->references('id')->on('car_types')->onDelete('cascade');
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
        Schema::drop('car_reservation_details');
    }
}
