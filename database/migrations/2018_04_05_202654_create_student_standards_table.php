<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class CreateStudentStandardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_standards', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->unsigned();
            $table->integer('standard_id')->unsigned();
            
            $table->date('u_type')->default(Carbon::now());
            $table->boolean('u_status')->default(1);

            $table->date('t_type')->nullable();
            $table->boolean('t_status')->default(0);

            $table->date('a_type')->nullable();
            $table->boolean('a_status')->default(0);

            $table->date('m_type')->nullable();
            $table->boolean('m_status')->default(0);

            $table->date('e_type')->nullable();
            $table->boolean('e_status')->default(0);

            $table->foreign('standard_id')
            ->references('id')->on('standards')
            ->onDelete('cascade');

            $table->foreign('student_id')
            ->references('id')->on('students')
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
        Schema::dropIfExists('student_standards');
    }
}
