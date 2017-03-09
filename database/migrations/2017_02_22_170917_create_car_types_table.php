<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->text('description');
            $table->decimal('price_per_day', 10, 2)->default(0);
            $table->decimal('price_per_hour', 10, 2)->default(0);
            $table->integer('limit_mileage')->default(0);
            $table->decimal('extra_mileage', 10, 2)->default(0);
            $table->integer('total_passengers')->default(0);
            $table->integer('total_bags')->default(0);
            $table->integer('total_doors')->default(0);
            $table->enum('transmission', ['Manual', 'Automatic', 'Semi-automatic']);
            $table->string('thumb_path')->nullable();
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
        Schema::drop('car_types');
    }
}
