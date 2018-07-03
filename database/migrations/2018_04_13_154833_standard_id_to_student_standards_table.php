<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StandardIdToStudentStandardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student_standards', function (Blueprint $table) {
            $table->integer('standard_id')->unsigned()->after('student_id');

            $table->foreign('standard_id')
            ->references('id')->on('standards')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student_standards', function (Blueprint $table) {
            //
        });
    }
}
