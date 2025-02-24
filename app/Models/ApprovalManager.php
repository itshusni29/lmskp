<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApprovalManager extends Model
{
    use HasFactory;

    // Table name
    protected $table = 'approvals_manager';

    // Fillable attributes for mass assignment
    protected $fillable = [
        'training_stage_id',
        'user_id',
        'manager_id',
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

    // Manager relation
    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }
}
