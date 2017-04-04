<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarModelPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_model_prices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('model_id')->unsigned();
            $table->date('date_from')->nullable();
            $table->date('date_to')->nullable();
            $table->smallInteger('from')->default(0);
            $table->smallInteger('to')->default(0);
            $table->decimal('price', 10, 2)->default(0);
            $table->enum('price_per', ['hour', 'day']);
            $table->timestamps();

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
        Schema::drop('car_model_prices');
    }
}
