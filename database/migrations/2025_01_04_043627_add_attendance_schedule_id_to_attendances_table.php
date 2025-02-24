<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->unsignedBigInteger('attendance_schedule_id')->after('user_id');
            $table->foreign('attendance_schedule_id')->references('id')->on('attendance_schedules')->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->dropForeign(['attendance_schedule_id']);
            $table->dropColumn('attendance_schedule_id');
        });
    }
    
};
