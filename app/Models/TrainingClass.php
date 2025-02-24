<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingClass extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'description',
        'instructor_id',
        'training_stage_id',
        'banner_image', 
    ];

    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function trainingStage()
    {
        return $this->belongsTo(TrainingStage::class, 'training_stage_id');
    }
    public function trainingModules()
    {
        return $this->hasMany(TrainingModule::class, 'training_class_id');
    }

}
