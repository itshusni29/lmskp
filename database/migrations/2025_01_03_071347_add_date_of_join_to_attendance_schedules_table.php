<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDateOfJoinToAttendanceSchedulesTable extends Migration
{
    public function up()
    {
        Schema::table('attendance_schedules', function (Blueprint $table) {
            // Menambahkan kolom date_of_join
            $table->date('date_of_join')->nullable(); // Anda bisa menyesuaikan nullable() jika diperlukan
        });
    }

    public function down()
    {
        Schema::table('attendance_schedules', function (Blueprint $table) {
            // Menghapus kolom date_of_join jika rollback
            $table->dropColumn('date_of_join');
        });
    }
}
