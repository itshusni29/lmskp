<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    use HasFactory;

    protected $fillable = [
        'trainer_id', 'participant_id', 'training_stage_id', 'ltc'
    ];

    // Relasi ke User sebagai trainer
    public function trainer()
    {
        return $this->belongsTo(User::class, 'trainer_id');
    }

    // Relasi ke User sebagai employee
    public function employee()
    {
        return $this->belongsTo(User::class, 'participant_id');
    }


    // Relasi ke AssessmentSubjects
    public function subjects()
    {
        return $this->hasMany(AssessmentSubject::class, 'assessment_id');
    }

    public function showParticipants()
    {
        // Ambil semua peserta
        $participants = User::where('role', 'participant')->get();

        // Periksa apakah setiap peserta memiliki assessment
        foreach ($participants as $participant) {
            $participant->assessment = Assessment::where('participant_id', $participant->id)->first();
        }

        return view('trainer.participants', compact('participants'));
    }


}
