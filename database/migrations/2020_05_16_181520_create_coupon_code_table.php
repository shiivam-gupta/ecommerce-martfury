<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponCodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupon_code', function (Blueprint $table) {
            $table->id();
            $table->text('title')->nullable();
            $table->integer('coupon_number')->nullable();
            $table->enum('type', ['1','2'])->default('1')->comment('1 = percentage and 2 = fixed');
            $table->double('percentage_amount', 10, 2)->nullable();
            $table->boolean('coupon_option')->default('1')->comment('1 = one time and 0 = multiple');
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
        Schema::dropIfExists('coupon_code');
    }
}
