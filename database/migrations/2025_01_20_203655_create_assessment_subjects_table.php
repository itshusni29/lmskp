<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssessmentSubjectsTable extends Migration
{
    public function up()
    {
        Schema::create('assessment_subjects', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('assessment_id')->constrained('assessments')->onDelete('cascade');
            $table->string('subject'); 
            $table->integer('score'); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('assessment_subjects');
    }
}
