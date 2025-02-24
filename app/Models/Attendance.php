<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $table = 'attendances';

    protected $fillable = [
        'user_id',
        'attendance_schedule_id',
        'attendance_date',
        'start_time',
        'end_time',
        'remarks',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function attendanceSchedule()
    {
        return $this->belongsTo(AttendanceSchedule::class, 'attendance_schedule_id');
    }

    protected $dates = ['attendance_date', 'start_time', 'end_time'];
}