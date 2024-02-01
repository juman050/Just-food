<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',255);
            $table->text('description');
            $table->string('startdate',128);
            $table->string('enddate',128);
            $table->string('days',128);
            $table->string('start_time',128);
            $table->string('end_time',128);
            $table->enum('status',['enable','disable'])->default('enable');
            $table->enum('display_banner',['yes','no'])->default('yes');
            $table->string('banner_image',255)->nullable();
            $table->integer('customer_use')->nullable();
            $table->enum('free_shipping',['yes','no'])->default('no');
            $table->string('coupon_code',255)->nullable();
            $table->integer('custom_int')->nullable();
            $table->string('custom_text',500)->nullable();
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
        Schema::dropIfExists('offers');
    }
}
