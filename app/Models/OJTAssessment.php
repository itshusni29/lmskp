<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OJTAssessment extends Model
{
    use HasFactory;  // Added to use factories

    protected $fillable = [
        'trainer_id', 'participant_id', 'ltc'
    ];

    protected $table = 'o_j_t_assessments';  // Ensure the correct table name

    // Relationship to User as trainer
    public function trainer()
    {
        return $this->belongsTo(User::class, 'trainer_id');
    }

    // Relationship to User as employee (participant)
    public function employee()
    {
        return $this->belongsTo(User::class, 'participant_id');
    }

    // Relationship to OJTAssessmentSubjects
    public function subjects()
    {
        return $this->hasMany(OJTAssessmentSubject::class, 'assessment_id');
    }

    // Show participants with their assessment
    public function showParticipants()
    {
        // Get all participants who are assigned a training assessment
        $participants = User::where('role', 'participant')->with('assessment')->get();

        // Return the participants view, with their assessments loaded
        return view('trainer.participants', compact('participants'));
    }
}
