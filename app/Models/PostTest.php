<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostTest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'training_stage_id', 
        'description',
        'start_time',
        'end_time',
        'ltc'
    ];

    /**
     * Get the training stage that owns the PostTest.
     */
    public function trainingStage()
    {
        return $this->belongsTo(TrainingStage::class, 'training_stage_id'); 
    }

    /**
     * Get the questions associated with the PostTest.
     */
    public function questions()
    {
        return $this->hasMany(PostTestQuestion::class);
    }

    public function results()
    {
        return $this->hasMany(PostTestResult::class);
    }
}
