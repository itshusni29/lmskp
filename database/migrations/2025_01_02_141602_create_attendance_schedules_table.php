<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendanceSchedulesTable extends Migration
{
    public function up()
    {
        Schema::create('attendance_schedules', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->foreignId('training_stage_id')->constrained('training_stages'); // Foreign Key ke TrainingStages
            $table->date('attendance_date'); // Tanggal pengisian kehadiran
            $table->time('start_time'); // Waktu mulai
            $table->time('end_time'); // Waktu selesai
            $table->timestamps(); // created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('attendance_schedules');
    }
}
