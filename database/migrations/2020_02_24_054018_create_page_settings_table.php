<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_page_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('home_title',255)->default('Justfood | Home');
            $table->text('home_meta_description')->nullable();
            $table->string('home_caption',255)->nullable();
            $table->longText('home_description')->nullable();
            $table->string('home_tagline',255)->nullable();
            $table->string('home_background_image',255)->default('home_background.png');
            $table->string('home_custom_text',255)->nullable();
            $table->text('home_custom_textarea')->nullable();
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
        Schema::dropIfExists('home_page_settings');
    }
}
