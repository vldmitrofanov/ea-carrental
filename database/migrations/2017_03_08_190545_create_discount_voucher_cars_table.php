<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscountVoucherCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount_voucher_cars', function (Blueprint $table) {
            $table->integer('voucher_id')->unsigned();
            $table->integer('car_id')->unsigned();

            $table->foreign('voucher_id')->references('id')->on('discount_vouchers')->onDelete('cascade');
            $table->foreign('car_id')->references('id')->on('rental_cars')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('discount_voucher_cars');
    }
}
