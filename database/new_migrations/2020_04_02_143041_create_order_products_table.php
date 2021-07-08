<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProductsTable extends Migration
{
    public function up()
    {
        Schema::create('order_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("order_id");
            $table->string("product_id");
            $table->integer("quantity");
            $table->integer("price");
            $table->string("customer_id");
            $table->string("size")->nullable();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('order_products');
    }
}
