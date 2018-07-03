<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('ar_name');
            $table->string('en_name');
            $table->string('url')->nullable();
            $table->string('ar_address');
            $table->string('en_address');
            $table->string('phone');
            $table->string('ar_delegate')->nullable();
            $table->string('en_delegate')->nullable();
            $table->string('image')->default('default.png');
            $table->boolean('active')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('schools');
    }
}
