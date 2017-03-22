<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFreebieDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount_freebies_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('discount_freebies_id')->unsigned();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->integer('car_id')->unsigned();
            $table->timestamps();

            $table->foreign('discount_freebies_id')->references('id')->on('discount_freebies')->onDelete('cascade');
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
        Schema::drop('discount_freebies_detail');
    }
}
