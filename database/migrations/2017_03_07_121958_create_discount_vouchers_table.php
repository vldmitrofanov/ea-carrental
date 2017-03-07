<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscountVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount_vouchers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('voucher_code')->default('');
            $table->decimal('amount', 10, 2)->default(0);
            $table->enum('amount_type', ['amount', 'percent'])->default('amount');
            $table->dateTime('valid_from')->nullable();
            $table->dateTime('valid_to')->nullable();            
            $table->enum('discount_type', ['all', 'selected'])->default('all');
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
        Schema::drop('discount_vouchers');
    }
}
