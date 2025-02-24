<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'username', 'name', 'email', 'password', 'section', 
        'department', 'division', 'date_of_join', 'occupation', 
        'role', 'date_of_birth', 'sex', 'cc', 'ltc',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'date_of_join' => 'date',
        'date_of_birth' => 'date',
    ];

    // One-to-One relationship with OJTAssessment (Participant)
    public function ojtAssessment()
    {
        return $this->hasOne(OJTAssessment::class, 'participant_id');
    }

    // One-to-Many relationship with OJTAssessment (Trainer)
    public function trainerAssessments()
    {
        return $this->hasMany(OJTAssessment::class, 'trainer_id');
    }

    // One-to-One relationship with ICAssessment (Participant)
    public function icAssessment()
    {
        return $this->hasOne(ICAssessment::class, 'participant_id');
    }

    // One-to-Many relationship with ICAssessment (Trainer)
    public function icTrainerAssessments()
    {
        return $this->hasMany(ICAssessment::class, 'trainer_id');
    }

    // One-to-Many relationship with ApprovalManager
    public function approvalManagers()
    {
        return $this->hasMany(ApprovalManager::class, 'manager_id');
    }

    // One-to-Many relationship with ApprovalSpvTraining
    public function approvalSpvTrainings()
    {
        return $this->hasMany(ApprovalSpvTraining::class, 'spv_training_id');
    }
    // Di dalam model User
    public function spvApproval()
    {
        return $this->hasOne(ApprovalSpvTraining::class, 'user_id', 'id')
            ->where('training_stage_id', 1); // Jika approval hanya untuk tahap Induction Training
    }
    public function attendanceSchedules()
    {
        return $this->hasMany(AttendanceSchedule::class);
    }
    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'user_id');
    }

}