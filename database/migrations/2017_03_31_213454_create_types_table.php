<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fleet_types', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sipp_code_one')->default(0)->comment('referecne to SIPP code having latter A');
            $table->integer('sipp_code_two')->default(0)->comment('referecne to SIPP code having latter B');
            $table->integer('sipp_code_three')->default(0)->comment('referecne to SIPP code having latter C');
            $table->integer('sipp_code_four')->default(0)->comment('referecne to SIPP code having latter D');
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
        Schema::drop('fleet_types');
    }
}
