<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateICAssessmentsTable extends Migration
{
    public function up()
    {
        Schema::create('i_c_assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trainer_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('participant_id')->constrained('users')->onDelete('cascade');
            $table->string('ltc'); // Preserve the ltc field
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('i_c_assessments');
    }
}
