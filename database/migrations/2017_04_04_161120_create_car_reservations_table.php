<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::drop('rental_car_reservations');

        Schema::create('rental_car_reservations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('reservation_number');
            $table->string('ip_address')->default('');
            $table->integer('user_id')->unsigned();
            $table->dateTime('processed_on');
            $table->string('txn_id')->default('');

            $table->enum('status', ['pending', 'confirmed', 'cancelled', 'collected', 'completed'])->default('pending');
            $table->enum('payment_method', ['paypal', 'authorize', 'creditcard', 'bank', 'cash'])->default('cash');
            $table->string('cc_type')->default('');
            $table->string('cc_num')->default('');
            $table->string('cc_exp')->default('');
            $table->string('cc_code')->default('');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::drop('rental_car_reservations');
    }
}
