<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->foreignId('user_id')->constrained('users'); // Foreign Key to Users (students)
            $table->foreignId('training_stage_id')->constrained('training_stages'); // Foreign Key to TrainingStages
            $table->date('attendance_date'); // Date of attendance
            $table->time('start_time'); // Start time of the attendance
            $table->time('end_time'); // End time of the attendance
            $table->text('remarks')->nullable(); // Optional remarks
            $table->timestamps(); // created_at and updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('attendances');
    }
}
