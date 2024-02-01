<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryCollectionOthersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_collection_others', function (Blueprint $table) {
            $table->increments('id');

            $table->enum('deliveryMethod', ['delivery', 'collection', 'both'])->default('both');
            $table->integer('deliveryTimeLimit')->default(20);
            $table->integer('collectionTimeLimit')->default(10);

            $table->enum('mileage_or_postcode', ['mileage', 'postcode'])->default('postcode');

            $table->string('menu_file',500)->nullable();
            $table->enum('menu_file_status', ['enable', 'disable'])->default('disable');

            $table->enum('table_book_status', ['enable', 'disable'])->default('disable');
            
            $table->enum('home_page_status', ['enable', 'disable'])->default('disable');
            $table->enum('contact_page_status', ['enable', 'disable'])->default('disable');
            $table->enum('gallery_page_status', ['enable', 'disable'])->default('disable');
            $table->enum('menu_page_status', ['enable', 'disable'])->default('disable');
            $table->enum('privacy_page_status', ['enable', 'disable'])->default('disable');
            $table->enum('terms_page_status', ['enable', 'disable'])->default('disable');

            $table->enum('pre_order_status', ['enable', 'disable'])->default('disable');
            $table->enum('special_reequest_status', ['enable', 'disable'])->default('enable');
            $table->enum('instant_open_close', ['enable', 'disable'])->default('disable');
            $table->enum('image_showing', ['enable', 'disable'])->default('enable');

            $table->enum('free_shipping_status', ['enable', 'disable'])->default('disable');
            $table->integer('amount_for_free_shipping')->default(500);

            
            

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
        Schema::dropIfExists('delivery_collection_others');
    }
}
