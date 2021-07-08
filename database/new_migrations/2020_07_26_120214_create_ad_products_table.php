<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdProductsTable extends Migration
{

    public function up()
    {
        Schema::create('ad_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("title");
            $table->string("image");
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ad_products');
    }
}
