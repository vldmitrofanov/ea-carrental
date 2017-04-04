<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackageModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount_package_models', function (Blueprint $table) {
            $table->integer('discount_package_id')->unsigned();
            $table->integer('model_id')->unsigned();

            $table->foreign('discount_package_id')->references('id')->on('discount_packages')->onDelete('cascade');
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
        Schema::drop('discount_package_models');
    }
}
