<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OJTAssessmentSubject extends Model
{
    use HasFactory; // Add HasFactory for factory support

    protected $fillable = ['assessment_id', 'subject', 'score'];
    public $timestamps = true;

    protected $table = 'o_j_t_assessment_subjects';
    // Define the relationship with OJTAssessment
    public function assessment()
    {
        return $this->belongsTo(OJTAssessment::class, 'assessment_id');
    }
}
