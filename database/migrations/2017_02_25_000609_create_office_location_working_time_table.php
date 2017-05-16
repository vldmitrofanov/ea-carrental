<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfficeLocationWorkingTimeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('office_location_working_times', function (Blueprint $table) {
            $table->increments('id');
            $table->time('monday_from')->nullable();
            $table->time('monday_to')->nullable();
            $table->boolean('monday_dayoff')->default(0);

            $table->time('tuesday_from')->nullable();
            $table->time('tuesday_to')->nullable();
            $table->boolean('tuesday_dayoff')->default(0);

            $table->time('wednesday_from')->nullable();
            $table->time('wednesday_to')->nullable();
            $table->boolean('wednesday_dayoff')->default(0);

            $table->time('thursday_from')->nullable();
            $table->time('thursday_to')->nullable();
            $table->boolean('thursday_dayoff')->default(0);

            $table->time('friday_from')->nullable();
            $table->time('friday_to')->nullable();
            $table->boolean('friday_dayoff')->default(0);

            $table->time('saturday_from')->nullable();
            $table->time('saturday_to')->nullable();
            $table->boolean('saturday_dayoff')->default(0);

            $table->time('sunday_from')->nullable();
            $table->time('sunday_to')->nullable();
            $table->boolean('sunday_dayoff')->default(0);

            $table->integer('location_id')->unsigned();
            $table->timestamps();

//            $table->foreign('location_id')->references('id')->on('office_locations')
//                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('office_location_working_times');
    }
}
