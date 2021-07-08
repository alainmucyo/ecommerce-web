<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeSectionsTable extends Migration
{

    public function up()
    {
        Schema::create('home_sections', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("name");
            $table->timestamps();
        });
    }

  public function down()
    {
        Schema::dropIfExists('home_sections');
    }
}
