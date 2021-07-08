<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentModesTable extends Migration
{

    public function up()
    {
        Schema::create('payment_modes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("name");
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('payment_modes');
    }
}
