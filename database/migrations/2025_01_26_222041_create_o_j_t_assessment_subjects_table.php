<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOJTAssessmentSubjectsTable extends Migration
{
    public function up()
    {
        Schema::create('o_j_t_assessment_subjects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assessment_id')->constrained('o_j_t_assessments')->onDelete('cascade');
            $table->string('subject');
            $table->integer('score');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('o_j_t_assessment_subjects');
    }
}
