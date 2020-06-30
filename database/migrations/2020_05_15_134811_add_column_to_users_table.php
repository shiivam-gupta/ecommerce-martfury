<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->text('latitude')->nullable()->after('dob');
            $table->text('logitude')->nullable()->after('latitude');
            $table->integer('country_id')->nullable()->after('logitude');
            $table->integer('state_id')->nullable()->after('country_id');
            $table->integer('city_id')->nullable()->after('state_id');
            $table->text('address')->nullable()->after('city_id');
            $table->integer('pincode')->nullable()->after('address');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('latitude');
            $table->dropColumn('logitude');
            $table->dropColumn('country_id');
            $table->dropColumn('state_id');
            $table->dropColumn('city_id');
            $table->dropColumn('address');
            $table->dropColumn('pincode');
        });
    }
}
