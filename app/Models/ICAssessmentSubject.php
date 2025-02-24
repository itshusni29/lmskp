<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ICAssessmentSubject extends Model
{
    use HasFactory;  // Add HasFactory for factory support

    protected $fillable = ['assessment_id', 'subject', 'score'];
    public $timestamps = true;

    protected $table = 'i_c_assessment_subjects';

    // Define the relationship with ICAssessment
    public function assessment()
    {
        return $this->belongsTo(ICAssessment::class, 'assessment_id');
    }
}
