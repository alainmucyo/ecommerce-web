<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryProductTable extends Migration
{

    public function up()
    {
        Schema::create('category_product', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("product_id");
            $table->string("category_id");
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('category_product');
    }
}
