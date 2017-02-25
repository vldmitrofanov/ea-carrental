<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfficeLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('office_locations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('email');
            $table->string('state');
            $table->string('city');
            $table->string('address');
            $table->integer('country_id')->unsigned();
            $table->string('zip');
            $table->string('phone');
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->boolean('notify_email')->default(0);
            $table->string('thumb_path')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();

//            $table->foreign('country_id')->references('id')->on('countries')
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
        Schema::drop('office_locations');
    }
}
