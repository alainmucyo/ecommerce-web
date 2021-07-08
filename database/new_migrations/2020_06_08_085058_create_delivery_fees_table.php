<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryFeesTable extends Migration
{

    public function up()
    {
        Schema::create('delivery_fees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("title");
            $table->text("details");
            $table->boolean("status")->default(0);
            $table->string("product_id");
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('delivery_fees');
    }
}
