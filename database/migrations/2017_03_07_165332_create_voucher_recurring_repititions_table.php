<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoucherRecurringRepititionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount_voucher_recurring_rule_repititions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('voucher_id')->unsigned();
            $table->integer('rule_id')->unsigned();
            $table->dateTime('start_repeat')->nullable();
            $table->dateTime('end_repeat')->nullable();
            $table->timestamps();

            $table->foreign('voucher_id')->references('id')->on('discount_vouchers')->onDelete('cascade');
            $table->foreign('rule_id')->references('id')->on('discount_voucher_recurring_rules')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('discount_voucher_recurring_rule_repititions');
    }
}
