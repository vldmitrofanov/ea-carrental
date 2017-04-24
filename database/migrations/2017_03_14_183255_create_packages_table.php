<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount_packages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->decimal('discount_amount', 10, 2)->default(0);
            $table->enum('discount_type', ['amount', 'percent'])->default('amount');
            $table->integer('booking_duration')->default(0);
            $table->enum('booking_duration_type', ['days', 'weeks', 'month'])->default('days');
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();

            $table->enum('discount_package_type', ['all', 'selected'])->default('all');
            $table->boolean('status')->default(true);
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('discount_packages');
    }
}
