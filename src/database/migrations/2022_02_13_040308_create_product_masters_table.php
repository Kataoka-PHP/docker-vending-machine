<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_masters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('product_name');
            $table->string('image');
            $table->integer('price');
            $table->dateTime('sales_start_time')->nullable();
            $table->dateTime('sales_end_time')->nullable();
            $table->integer('display_order');
            $table->dateTime('registration_time')->nullable();
            $table->dateTime('update_time')->nullable();
            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_masters');
    }
}