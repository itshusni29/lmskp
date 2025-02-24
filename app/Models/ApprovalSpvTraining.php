<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApprovalSpvTraining extends Model
{
    use HasFactory;

    // Table name
    protected $table = 'approvals_spv_training';

    // Fillable attributes for mass assignment
    protected $fillable = [
        'training_stage_id',
        'user_id',
        'spv_training_id',
        'approval_status',
        'remark',
    ];

    // Defining relationships

    // Training stage relation
    public function trainingStage()
    {
        return $this->belongsTo(TrainingStage::class);
    }

    // User (trainee) relation
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Supervisor relation
    public function supervisor()
    {
        return $this->belongsTo(User::class, 'spv_training_id');
    }
}


