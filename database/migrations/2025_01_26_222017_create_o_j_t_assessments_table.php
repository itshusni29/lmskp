<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOJTAssessmentsTable extends Migration
{
    public function up()
    {
        Schema::create('o_j_t_assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trainer_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('participant_id')->constrained('users')->onDelete('cascade');
            $table->string('ltc');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('o_j_t_assessments');
    }
}
