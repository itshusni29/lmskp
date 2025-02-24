<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use App\Models\OJTAssessment;
use App\Models\OJTAssessmentSubject;
use App\Models\User;
use Illuminate\Http\Request;

class OJTAssessmentController extends Controller
{
    public function indexOJT()
    {
        $trainer = auth()->user();
        $participants = User::where('section', $trainer->section)
                             ->where('role', 'participant')
                             ->with('ojtAssessment') // Ensure it's the correct relationship name
                             ->get();
    
        return view('pages.trainer.assessments.indexojt', compact('participants'));
    }
    public function createOJT($participantId)
    {
        $trainer = auth()->user();
        $participant = User::findOrFail($participantId); // Find user by ID
    
        $ltc = $participant->ltc ?? 'common'; // Get LTC value for the participant
    
        return view('pages.trainer.assessments.createojt', compact('participant', 'ltc'));
    }
    public function storeOJT(Request $request)
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
            // Store OJTAssessment
            $assessment = OJTAssessment::create([
                'trainer_id'   => $request->trainer_id,
                'participant_id' => $request->participant_id,
                'ltc'           => $request->ltc
            ]);

            // Store associated subjects using create()
            foreach ($request->subjects as $subjectData) {
                OJTAssessmentSubject::create([
                    'assessment_id' => $assessment->id,
                    'subject'       => $subjectData['subject'],
                    'score'         => $subjectData['score'],
                ]);
            }

            return redirect()->route('trainer.assessments.ojt')
                ->with('success', 'Assessment berhasil dibuat.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal menyimpan assessment: ' . $e->getMessage()]);
        }
    }
    public function editOJT($assessmentId)
    {
        $assessment = OJTAssessment::with('subjects')->findOrFail($assessmentId); // Find the OJT assessment
        $participant = User::findOrFail($assessment->participant_id); // Get the associated participant
     
        $ltc = $participant->ltc ?? 'common'; // Get LTC value for the participant
     
        return view('pages.trainer.assessments.editojt', compact('assessment', 'participant', 'ltc'));
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

        $assessment = OJTAssessment::findOrFail($id); // Find the assessment

        try {
            // Update the OJTAssessment data. The 'updated_at' timestamp will automatically be updated
            $assessment->update($request->only(['trainer_id', 'participant_id', 'ltc']));

            // Delete old subjects before updating
            $assessment->subjects()->delete();

            // Store updated subjects using create()
            foreach ($request->subjects as $subjectData) {
                OJTAssessmentSubject::create([
                    'assessment_id' => $assessment->id,
                    'subject'       => $subjectData['subject'],
                    'score'         => $subjectData['score'],
                ]);
            }

            return redirect()->route('trainer.assessments.ojt')
                ->with('success', 'Assessment berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal memperbarui assessment: ' . $e->getMessage()]);
        }
    } 
}
