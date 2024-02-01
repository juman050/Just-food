<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('store_name',100)->default('Food House');
            $table->string('store_address',100)->default('332 Bethnal Green Road');
            $table->string('store_city',100)->default('London');
            $table->string('store_state',100)->nullable();
            $table->string('store_country',100)->default('United Kingdom');
            $table->string('store_postcode',100)->default('E2 0AG');
            $table->string('store_support_number',100)->default('+8801746150145');
            $table->string('store_support_email',100)->default('john.justfood@gmail.com');
            $table->string('store_fax',100)->nullable();
            $table->string('store_owner_name',100)->nullable();
            $table->string('store_owner_number',100)->nullable();
            $table->string('store_owner_email',100)->nullable();
            $table->text('store_map')->nullable();
            $table->tinyInteger('store_active_theme')->default('1');
            $table->string('store_custom_text_1',255)->nullable();
            $table->string('store_custom_text_2',255)->nullable();
            $table->tinyInteger('store_extra_tiny')->default('0');
            $table->tinyInteger('store_extra_tiny_2')->default('1');
            $table->text('store_custom_textarea_1')->nullable();
            $table->text('store_custom_textarea_2')->nullable();
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
        Schema::dropIfExists('store_settings');
    }
}
