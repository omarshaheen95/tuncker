<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ar_name');
            $table->string('en_name');
            $table->integer('school_id')->unsigned();
            $table->integer('teacher_id')->unsigned();
            $table->date('dob');
            
            $table->string('nationality');
            $table->integer('year_lang');
            $table->string('image');
            

            $table->foreign('teacher_id')
            ->references('id')->on('teachers')
            ->onDelete('cascade');

            $table->foreign('school_id')
            ->references('id')->on('schools')
            ->onDelete('cascade');

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
        Schema::dropIfExists('students');
    }
}
