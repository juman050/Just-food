<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGalleryPageSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gallery_page_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('gallery_title',500)->default('Justfood | Gallery');
            $table->longText('gallery_meta_description')->nullable();
            $table->text('gallery_custom_text')->nullable();
            $table->text('gallery_custom_textarea')->nullable();
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
        Schema::dropIfExists('gallery_page_settings');
    }
}
