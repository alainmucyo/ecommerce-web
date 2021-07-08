<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{

    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("title");
            $table->string("slug")->unique();
            $table->integer("price");
            $table->integer("client_max");
            $table->text("sizes")->nullable();
            $table->longText("description");
            $table->smallInteger("status")->default(1);
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('products');
    }
}
