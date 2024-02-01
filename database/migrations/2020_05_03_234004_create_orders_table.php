<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {

            $table->increments('id');

            $table->string('order_date',128);
            $table->string('order_delivery_time',255);
            $table->enum('order_delivery_type',['delivery','collection']);
            $table->double('order_extra_fee', 5, 2);
            $table->double('order_delivery_charge', 5, 2);
            $table->double('order_subtotal', 5, 2);
            $table->double('order_total', 5, 2);
            $table->integer('order_total_item');
            $table->enum('order_pay_method',['cash','online']);
            $table->integer('login_user_id')->nullable();
            $table->string('order_customer_name',255);
            $table->string('order_contact_number',255);
            $table->string('order_email',255);
            $table->string('order_address',500);
            $table->string('order_postcode',255);
            $table->string('order_postcode_details',255)->nullable();
            $table->string('order_special_request',500)->nullable();
            $table->enum('order_payment_status',['pending','done'])->default('pending');
            $table->enum('order_status',['pending', 'processing', 'delivered'])->default('pending');
            $table->string('inserted',255);

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
        Schema::dropIfExists('orders');
    }
}
