<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');

            $table->string('item_name',255);
            $table->string('item_description',500)->nullable();
            $table->string('item_image',255)->default('default_item_image.png')->nullable();

            $table->integer('item_cat_id');

            $table->double('item_new_price', 5, 2);
            $table->double('item_old_price', 5, 2)->nullable();

            $table->enum('item_delivery_type',['delivery','collection','both'])->default('both');

            $table->enum('item_variance',['yes','no'])->default('no');
            $table->enum('item_sub_menu',['yes','no'])->default('no');
            $table->enum('item_sp_request_sts',['yes','no'])->default('no');

            $table->enum('item_offer_include',['yes','no'])->default('yes');
            $table->enum('item_spice_level',['low','medium','high','no_spice'])->default('no_spice');

            $table->integer('cus_int_field')->nullable();
            $table->string('cus_text_field',500)->nullable();
            $table->tinyInteger('cus_tinyInt_field')->default(0)->nullable();

            $table->enum('status',['enable','disable'])->default('enable');
            $table->integer('sort')->default(0);

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
        Schema::dropIfExists('items');
    }
}
