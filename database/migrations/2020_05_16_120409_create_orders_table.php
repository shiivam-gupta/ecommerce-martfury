<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->string('address');
            $table->string('additional_note')->nullable();
            $table->integer('currency_id')->nullable();
            $table->double('subtotal', 10, 2)->default('0.00');
            $table->double('total_discount', 10, 2)->default('0.00');
            $table->double('total_tax', 10, 2)->default('0.00');
            $table->double('total', 10, 2)->default('0.00');
            $table->string('coupon_code')->nullable();
            $table->enum('payby', ['cod', 'payumoney','razorpay'])->nullable();
            $table->string('transaction_id', 50)->nullable();
            $table->string('payment_status', 50)->nullable();
            $table->enum('status', ['pending', 'delivered','confirmed','cancelled'])->default('pending');
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
        Schema::dropIfExists('orders');
    }
}
