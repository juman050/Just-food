<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemVariancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_variances', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_id');
            $table->integer('variance_id');
            $table->double('item_new_price', 5, 2);
            $table->double('item_old_price', 5, 2)->nullable();
            $table->integer('sort')->default(0);
            $table->enum('status',['enable','disable'])->default('enable');
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
        Schema::dropIfExists('item_variances');
    }
}
