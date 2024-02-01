<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubItemVarianceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_item_variance', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sub_item_variance_name',255);
            $table->double('item_variance_new_price', 5, 2);
            $table->double('item_variance_old_price', 5, 2)->nullable();
            $table->enum('status',['enable','disable'])->default('enable');
            $table->integer('sort')->default(0);
            $table->integer('sub_item_id');
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
        Schema::dropIfExists('sub_item_variance');
    }
}
