<?php

namespace App\Http\Controllers\rekap;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\OJTAssessment;

class rekapOnTheJobTrainingController extends Controller
{
    public function index(Request $request)
    {
 
        
        // Get distinct "date_of_join" values and order them
        $datesOfJoin = User::select('date_of_join')
            ->distinct()
            ->orderByDesc('date_of_join')
            ->pluck('date_of_join');
        
        // Set default date_of_join to the latest
        $defaultDoj = $datesOfJoin->first();
            
        // Get users based on selected or default date_of_join and the manager's department
        $selectedDateOfJoin = $request->get('date_of_join', $defaultDoj);
        $users = User::where('date_of_join', $selectedDateOfJoin)
            ->get();
        
        // Get all OJT assessments without filtering by training_stage_id
        $assessments = OJTAssessment::with('subjects') // Eager load subjects related to each OJT assessment
            ->get();
        
        // Process the assessments data with corresponding user data
        $assessmentsData = $assessments->isEmpty() ? collect() : $assessments->map(function ($assessment) use ($users) {
            $userResults = $users->isEmpty() ? collect() : $users->map(function ($user) use ($assessment) {
                // Check if assessment relates to this user
                $relatedAssessment = $assessment->participant_id === $user->id ? $assessment : null;

                if (!$relatedAssessment) {
                    return [
                        'user' => $user,
                        'subjects' => [],
                        'status' => 'No Data',
                    ];
                }

                // Ensure subjects exist before accessing them
                $subjects = $relatedAssessment->subjects ?? collect(); // Use an empty collection if subjects do not exist
                $subjectsData = $subjects->map(function ($subject) {
                    $status = $subject->score >= 3 ? 'Passed' : 'Failed'; // Set status based on score
                    return [
                        'subject' => $subject->subject,  // Subject name
                        'score' => $subject->score,      // Subject score
                        'status' => $status,             // "Passed" or "Failed"
                    ];
                });

                // Check if all subjects passed
                $overallStatus = $subjects->every(function ($subject) {
                    return $subject->score >= 3;
                }) ? 'Passed' : 'Failed';

                return [
                    'user' => $user,
                    'subjects' => $subjectsData,  // Send subjects data
                    'status' => $overallStatus,   // Overall status
                ];
            });

            return [
                'assessment' => $assessment,
                'userResults' => $userResults,
            ];
        });
        
        return view('pages.admin.rekap_training_stages.on_the_job_training', [
            'users' => $users,
            'datesOfJoin' => $datesOfJoin,
            'defaultDoj' => $defaultDoj,
            'assessmentsData' => $assessmentsData,
        ]);
    }
}
