<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuPageSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_page_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('menu_title',500)->default('Justfood | Menu');
            $table->longText('menu_meta_description')->nullable();
            $table->string('menu_custom_text',255)->nullable();
            $table->text('menu_custom_textarea')->nullable();
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
        Schema::dropIfExists('menu_page_settings');
    }
}
