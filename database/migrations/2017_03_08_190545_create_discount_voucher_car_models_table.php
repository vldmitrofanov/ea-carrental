<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscountVoucherCarModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount_voucher_car_models_types', function (Blueprint $table) {
            $table->integer('voucher_id')->unsigned();
            $table->integer('model_id')->unsigned();

            $table->foreign('voucher_id')->references('id')->on('discount_vouchers')->onDelete('cascade');
            $table->foreign('model_id')->references('id')->on('car_models')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('discount_voucher_car_models_types');
    }
}
