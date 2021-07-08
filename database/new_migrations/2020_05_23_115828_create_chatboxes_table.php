<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatboxesTable extends Migration
{

    public function up()
    {
        Schema::create('chatboxes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("customer_id");
            $table->string("seller_id");
            $table->text("message");
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('chatboxes');
    }
}
