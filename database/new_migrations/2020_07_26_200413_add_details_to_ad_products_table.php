<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDetailsToAdProductsTable extends Migration
{
    public function up()
    {
        Schema::table('ad_products', function (Blueprint $table) {
            $table->text("details");
        });
    }


    public function down()
    {
        Schema::table('ad_products', function (Blueprint $table) {
            //
        });
    }
}
