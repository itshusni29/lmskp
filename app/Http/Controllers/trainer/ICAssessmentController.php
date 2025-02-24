<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use App\Models\ICAssessment;
use App\Models\ICAssessmentSubject;
use App\Models\User;
use Illuminate\Http\Request;

class ICAssessmentController extends Controller
{
    public function indexIC()
    {
        $trainer = auth()->user();
        $participants = User::where('section', $trainer->section)
                             ->where('role', 'participant')
                             ->with('icAssessment') // Ensure it's the correct relationship name
                             ->get();
    
        return view('pages.trainer.assessments.indexic', compact('participants'));
    }

    public function create($participantId)
    {
        $trainer = auth()->user();
        $participant = User::findOrFail($participantId); // Find user by ID
    
        $ltc = $participant->ltc ?? 'common'; // Get LTC value for the participant
    
        return view('pages.trainer.assessments.createic', compact('participant', 'ltc'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'trainer_id'         => 'required|exists:users,id',
            'participant_id'     => 'required|exists:users,id',
            'ltc'                => 'required|string|in:aluminium,steel,common',
            'subjects'           => 'required|array|min:1',
            'subjects.*.subject' => 'required|string|max:255',
            'subjects.*.score'   => 'required|integer|between:1,5',
        ]);

        try {
            // Store ICAssessment
            $assessment = ICAssessment::create([
                'trainer_id'   => $request->trainer_id,
                'participant_id' => $request->participant_id,
                'ltc'           => $request->ltc
            ]);

            // Store associated subjects using create()
            foreach ($request->subjects as $subjectData) {
                ICAssessmentSubject::create([
                    'assessment_id' => $assessment->id,
                    'subject'       => $subjectData['subject'],
                    'score'         => $subjectData['score'],
                ]);
            }

            return redirect()->route('trainer.assessments.ic')
                ->with('success', 'Assessment berhasil dibuat.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal menyimpan assessment: ' . $e->getMessage()]);
        }
    }

    public function edit($assessmentId)
    {
        $assessment = ICAssessment::with('subjects')->findOrFail($assessmentId); // Find the IC assessment
        $participant = User::findOrFail($assessment->participant_id); // Get the associated participant
     
        $ltc = $participant->ltc ?? 'common'; // Get LTC value for the participant
     
        return view('pages.trainer.assessments.editic', compact('assessment', 'participant', 'ltc'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'trainer_id'         => 'required|exists:users,id',
            'participant_id'     => 'required|exists:users,id',
            'ltc'                => 'required|string|in:aluminium,steel,common',
            'subjects'           => 'required|array|min:1',
            'subjects.*.subject' => 'required|string|max:255',
            'subjects.*.score'   => 'required|integer|between:1,5',
        ]);

        $assessment = ICAssessment::findOrFail($id); // Find the assessment

        try {
            // Update the ICAssessment data. The 'updated_at' timestamp will automatically be updated
            $assessment->update($request->only(['trainer_id', 'participant_id', 'ltc']));

            // Delete old subjects before updating
            $assessment->subjects()->delete();

            // Store updated subjects using create()
            foreach ($request->subjects as $subjectData) {
                ICAssessmentSubject::create([
                    'assessment_id' => $assessment->id,
                    'subject'       => $subjectData['subject'],
                    'score'         => $subjectData['score'],
                ]);
            }

            return redirect()->route('trainer.assessments.ic')
                ->with('success', 'Assessment berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal memperbarui assessment: ' . $e->getMessage()]);
        }
    }
}
