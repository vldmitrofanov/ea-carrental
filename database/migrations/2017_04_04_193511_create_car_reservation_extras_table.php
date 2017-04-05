<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarReservationExtrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::drop('rental_car_reservation_extras');
        Schema::create('rental_car_reservation_extras', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('reservation_id')->unsigned();
            $table->integer('extra_id')->unsigned();
            $table->integer('quantity')->unsigned()->default(0);
            $table->decimal('price', 10, 2)->default(0);
            $table->decimal('extended_price', 10, 2)->default(0);
            $table->text('extended_notes');
            $table->timestamps();

            $table->foreign('reservation_id')->references('id')->on('rental_car_reservations')->onDelete('cascade');
            $table->foreign('extra_id')->references('id')->on('car_extras')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('rental_car_reservation_extras');
    }
}
