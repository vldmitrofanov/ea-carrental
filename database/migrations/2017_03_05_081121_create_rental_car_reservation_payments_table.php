<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRentalCarReservationPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rental_car_reservation_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('reservation_id')->unsigned();
            $table->string('payment_method')->default('');
            $table->string('payment_type');
            $table->decimal('amount', 10, 2)->default(0);
            $table->enum('status', ['paid', 'notpaid']);
            $table->timestamps();

            $table->foreign('reservation_id')->references('id')->on('rental_car_reservations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('rental_car_reservation_payments');
    }
}
