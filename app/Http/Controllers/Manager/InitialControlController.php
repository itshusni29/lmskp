<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ICAssessment;
use App\Models\ApprovalManager; // Assuming you have a ApprovalManager model
use Illuminate\Http\Request;

class InitialControlController extends Controller
{
    public function index(Request $request)
    {
        // Get the logged-in manager
        $manager = auth()->user();
        
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
            ->where('department', $manager->department) // Filter by manager's department
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
                        'subjects' => [],  // No subjects if no related assessment
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
        
        // Pass the assessments data, users, and datesOfJoin to the view
        return view('pages.manager.training_stages.initial_control', [
            'users' => $users,
            'datesOfJoin' => $datesOfJoin,
            'defaultDoj' => $defaultDoj,
            'assessmentsData' => $assessmentsData,
            'manager' => $manager, // Pass the logged-in manager data to the view
        ]);
    }
    
    public function approveTraining(Request $request)
    {
        // Get the logged-in manager
        $manager = auth()->user();
        
        // Store the manager approval
        $approval = new ApprovalManager();
        $approval->training_stage_id = 4; // Auto-fill with stage ID 4
        $approval->manager_id = $manager->id; // Logged-in manager
        $approval->user_id = $request->user_id; // Selected user ID
        $approval->approval_status = $request->approval_status; // Approve/Reject status
        $approval->remark = $request->remark; // Optional remark
        $approval->save();
        
        return redirect()->back()->with('success', 'Approval saved successfully!');
    }
}
