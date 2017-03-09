<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('iso_alpha2',2)->default('');
            $table->string('iso_alpha3',3)->default('');
            $table->integer('iso_numeric')->default(0);
            $table->string('fips_code',3)->default('');
            $table->string('name',200)->default('');
            $table->string('capital',200)->default('');
            $table->bigInteger('areainsqkm')->default(0);
            $table->integer('population')->default(0);
            $table->char('continent',2)->default('');
            $table->string('tld',4)->default('');
            $table->char('currency_code',3)->default('');
            $table->string('currency_name',32)->default('');
            $table->string('phone',16)->default('');
            $table->string('postal_code_format',64)->default('');
            $table->string('postal_code_regex',255)->default('');
            $table->string('languages',200)->default('');
            $table->integer('geonameId')->default(0);
            $table->string('neighbours',64)->default('');
            $table->string('equivalent_fips_code',3)->default('');
            $table->string('currrency_symbol',3)->default('')->nullable();
            
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
        Schema::drop('countries');
    }
}
