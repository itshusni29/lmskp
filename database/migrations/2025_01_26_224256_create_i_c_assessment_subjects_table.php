<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateICAssessmentSubjectsTable extends Migration
{
    public function up()
    {
        Schema::create('i_c_assessment_subjects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assessment_id')->constrained('i_c_assessments')->onDelete('cascade');
            $table->string('subject');
            $table->integer('score');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('i_c_assessment_subjects');
    }
}
