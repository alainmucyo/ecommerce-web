<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCurrencyUsaAndDubaiCurrencyOnProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string("currency",20);
            $table->bigInteger("price_usa");
            $table->bigInteger("max_price_usa");
            $table->bigInteger("min_price_usa");
            $table->bigInteger("price_dirham");
            $table->bigInteger("max_price_dirham");
            $table->bigInteger("min_price_dirham");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
}
