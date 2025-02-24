<?php

namespace App\Http\Controllers\spv;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ICAssessment;
use App\Models\ApprovalSpvTraining;
use Illuminate\Http\Request;


class InitialControlController extends Controller
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
        $assessments = ICAssessment::with('subjects') // Eager load subjects related to each OJT assessment
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
        
        return view('pages.spv.training_stages.initial_control', [
            'users' => $users,
            'datesOfJoin' => $datesOfJoin,
            'defaultDoj' => $defaultDoj,
            'assessmentsData' => $assessmentsData,
        ]);
    }
    
    public function approveTraining(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'approval_status' => 'required|in:pending,approved,rejected',
            'remark' => 'nullable|string|max:255',
        ]);
    
        // Update or create approval record
        ApprovalSpvTraining::updateOrCreate(
            [
                'user_id' => $validated['user_id'],
                'training_stage_id' => 4,
            ],
            [
                'spv_training_id' => auth()->id(),
                'approval_status' => $validated['approval_status'],
                'remark' => $validated['remark'] ?? null,
            ]
        );
    
        return redirect()->to(url()->previous())->with('success', 'Approval successfully updated!');

    }
}





