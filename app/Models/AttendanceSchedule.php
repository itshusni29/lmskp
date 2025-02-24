<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceSchedule extends Model
{
    use HasFactory;

    protected $table = 'attendance_schedules';

    protected $fillable = [
        'training_stage_id',
        'attendance_date',
        'start_time',
        'end_time',
        'date_of_join',
    ];

    public function trainingStage()
    {
        return $this->belongsTo(TrainingStage::class);
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class, 'attendance_schedule_id');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'attendance_schedule_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'attendances');
    }


    public function attendanceForUser($userId)
    {
        return $this->attendance()->where('user_id', $userId)->first();
    }

    protected $dates = ['attendance_date', 'date_of_join'];
}
