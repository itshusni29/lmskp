<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EssayAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'essay_question_id',
        'training_module_id',
        'answer_text',
        'score',
        'graded_by',
        'graded_at',
    ];

    // Define the relationship to EssayQuestion model
    public function essayQuestion()
    {
        return $this->belongsTo(EssayQuestion::class);
    }

}
