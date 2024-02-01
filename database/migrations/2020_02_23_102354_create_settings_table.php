<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('theme_settings', function (Blueprint $table) {

            $table->increments('id');
            $table->string('site_title',100)->default('Just Food');
            $table->text('site_description')->nullable();
            $table->string('site_small_logo',100)->default('miniLogo.png');
            $table->string('site_main_logo',100)->default('mainiLogo.png');
            $table->string('site_pre_loader',100)->default('preLoader.gif');
            $table->string('site_fabicon',100)->default('fabIcon.png');
            $table->string('site_date_format',100)->default('j F, Y H:i a');
            $table->string('site_timezone',100)->default('Europe/London');
            $table->string('site_currency',100)->default('£');
            $table->string('site_language',100)->default('en');
            $table->string('site_android_url',255)->nullable();
            $table->string('site_ios_url',255)->nullable();
            $table->string('site_facebook_link',255)->nullable();
            $table->string('site_twitter_link',255)->nullable();
            $table->string('site_instagram_link',255)->nullable();
            $table->string('site_linkedin_link',255)->nullable();
            $table->string('site_google_plus_link',255)->nullable();
            $table->string('site_pinterest_link',255)->nullable();
            $table->string('site_youtube_link',255)->nullable();
            $table->string('site_copyright',255)->default('@all rights reserved juman');
            $table->tinyInteger('site_status')->nullable();
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
        Schema::dropIfExists('theme_settings');
    }
}
