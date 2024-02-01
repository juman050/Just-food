<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cat_name',255);
            $table->string('cat_description',500)->nullable();
            $table->string('cat_image',255)->default('default_cat_image.png')->nullable();
            $table->string('cat_available_days',255);
            $table->enum('cat_available_delivery_method',['delivery','collection','both'])->default('both');
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
        Schema::dropIfExists('categories');
    }
}
