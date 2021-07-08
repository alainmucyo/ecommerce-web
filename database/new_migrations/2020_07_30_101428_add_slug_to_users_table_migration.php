<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSlugToUsersTableMigration extends Migration
{

    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string("slug")->unique();
        });
    }


    public function down()
    {
        Schema::table('users_table_migration', function (Blueprint $table) {
            //
        });
    }
}
