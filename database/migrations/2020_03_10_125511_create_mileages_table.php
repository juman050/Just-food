<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMileagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mileages', function (Blueprint $table) {

            $table->increments('id');
            $table->string('mileage_length');
            $table->double('mileage_delivery_charge', 5, 2)->default(0);
            $table->double('mileage_minimum_order', 5, 2)->default(0);
            $table->enum('mileage_status', ['enable', 'disable'])->default('enable');
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
        Schema::dropIfExists('mileages');
    }
}
