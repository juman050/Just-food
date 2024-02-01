<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCantactPageSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_page_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('contact_title',500)->default('Justfood | Contact');
            $table->longText('contact_meta_description')->nullable();
            $table->text('contact_custom_text')->nullable();
            $table->text('contact_custom_textarea')->nullable();
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
        Schema::dropIfExists('contact_page_settings');
    }
}
