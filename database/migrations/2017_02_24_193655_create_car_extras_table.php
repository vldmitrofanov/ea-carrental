<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarExtrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_extras', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->decimal('price', 10, 2)->default(0);
            $table->integer('count')->default(0);
            $table->enum('per', ['booking', 'day']);
            $table->enum('type', ['single', 'multi']);
            $table->boolean('status')->default(1);
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
        Schema::drop('car_extras');
    }
}
