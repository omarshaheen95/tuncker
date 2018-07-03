<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('ar_name');
            $table->string('en_name');
            $table->string('ar_address');
            $table->string('en_address');
            $table->string('phone');
            $table->integer('school_id')->unsigned();
            $table->string('ar_description')->nullable();
            $table->string('en_description')->nullable();
            $table->string('image')->default('default.png');
            $table->boolean('active')->default(0);

            $table->foreign('school_id')
            ->references('id')->on('schools')
            ->onDelete('cascade');

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
        Schema::drop('teachers');
    }
}
