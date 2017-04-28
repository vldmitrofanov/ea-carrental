<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatSippCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sipp_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code_letter',1)->default('');
            $table->string('description')->default('');
            $table->enum('code_type', ['A', 'B', 'C', 'D'])->comment('The 4 letters describe different things - either the type of vehicle, the number of doors, the transmission or whether it has air conditioning.First letter = Size of vehicle, Second letter = (Number of doors), Third letter = (Transmission & drive), Fourth letter = (Fuel & A/C) ')->default('A');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sipp_codes');
    }
}
