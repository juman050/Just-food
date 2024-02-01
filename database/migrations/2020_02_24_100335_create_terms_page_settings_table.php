<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTermsPageSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terms_page_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('terms_title',500)->default('Justfood | Terms');
            $table->text('terms_meta_description')->nullable();
            $table->text('terms_description')->nullable();
            $table->text('terms_custom_text')->nullable();
            $table->text('terms_custom_textarea')->nullable();
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
        Schema::dropIfExists('terms_page_settings');
    }
}
