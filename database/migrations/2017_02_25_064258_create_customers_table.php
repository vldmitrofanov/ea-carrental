<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function($table) {
            $table->enum('title', ['Mr', 'Mrs', 'Ms', 'Dr', 'Prof', 'Rev', 'Other']);
            $table->string('company_name');
            $table->string('address');
            $table->string('state');
            $table->string('city');
            $table->string('zip');
            $table->integer('country_id')->unsigned();
            $table->text('other_info');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function($table) {
            $table->dropColumn('title');
            $table->dropColumn('company_name');
            $table->dropColumn('address');
            $table->dropColumn('state');
            $table->dropColumn('city');
            $table->dropColumn('zip');
            $table->dropColumn('country_id');
            $table->dropColumn('other_info');
        });
    }
}
