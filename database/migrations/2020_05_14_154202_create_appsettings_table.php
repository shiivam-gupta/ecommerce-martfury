<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Appsetting;

class CreateAppsettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appsettings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('app_name')->nullable();
            $table->string('app_logo')->nullable();
            $table->string('app_logo_footer')->nullable();
            $table->string('app_favicon')->nullable();
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->string('mobilenum')->nullable();
            $table->text('seo_keyword')->nullable();
            $table->text('seo_description')->nullable();
            $table->text('google_analytics')->nullable();
            $table->text('copyright')->nullable()->after('google_analytics');
            $table->text('safe_payment')->nullable()->after('copyright');
            $table->text('contact_title')->nullable()->after('safe_payment');
            $table->text('call_hours')->nullable()->after('contact_title');
            $table->string('contact_phone')->nullable()->after('call_hours');
            $table->text('contact_address')->nullable()->after('contact_phone');
            $table->text('newsletter_title')->nullable()->after('contact_address');
            $table->text('newsletter_description')->nullable()->after('newsletter_title');

            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('google_plus')->nullable();
            $table->string('instagram')->nullable();
            $table->timestamps();
        });

        $appsetting = new Appsetting;
        $appsetting->app_name = 'Ecommerce';
        $appsetting->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appsettings');
    }
}
