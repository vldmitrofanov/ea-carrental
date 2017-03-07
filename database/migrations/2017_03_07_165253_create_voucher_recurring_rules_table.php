<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoucherRecurringRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount_voucher_recurring_rules', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('voucher_id')->unsigned();
            $table->enum('frequency', ['none', 'daily', 'weekly', 'monthly', 'yearly'])->default('none');
            $table->integer('interval')->default(0);
            $table->string('byday')->default('');
            $table->dateTime('until_date')->nullable();
            $table->timestamps();

            $table->foreign('voucher_id')->references('id')->on('discount_vouchers')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('discount_voucher_recurring_rules');
    }
}
