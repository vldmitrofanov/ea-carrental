<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('title', ['Mr', 'Mrs', 'Ms', 'Dr', 'Prof', 'Rev', 'Other']);

            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone')->default('');
            $table->boolean('status')->default(1);
            $table->string('driver_licence')->default('');
            $table->string('passport_id')->default('');
            $table->string('rental_form')->default('');
            $table->string('company_name')->default('');
            $table->string('address')->default('');
            $table->string('state')->default('');
            $table->string('city')->default('');
            $table->string('zip')->default('');
            $table->integer('country_id')->unsigned()->default(0);
            $table->text('other_info');

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
