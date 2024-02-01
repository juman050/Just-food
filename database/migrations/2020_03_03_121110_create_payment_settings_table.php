<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('cash', ['enable', 'disable'])->default('enable');
            $table->enum('online', ['enable', 'disable'])->default('enable');

            $table->string('p_u',500)->nullable();
            $table->string('p_p',500)->nullable();
            $table->string('p_s',500)->nullable();
            $table->enum('p_a_t', ['test', 'live'])->default('test');
            $table->enum('p_e_d', ['enable', 'disable'])->default('disable');

            $table->string('s_p_k',500)->nullable();
            $table->string('s_s_k',500)->nullable();
            $table->enum('s_e_d', ['enable', 'disable'])->default('disable');

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
        Schema::dropIfExists('payment_settings');
    }
}
