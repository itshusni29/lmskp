<?php

namespace App\Http\Controllers\Manager;

use App\Models\PostTest;
use App\Models\PostTestResult;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ManagerDashboardController extends Controller
{
    /**
     * Display the manager's dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('pages.manager.dashboard');
    }


    
    public function inductionTraining(Request $request)
    {   
        // Get distinct dates of join and order them by the latest
        $dates_of_join = User::select('date_of_join')
            ->distinct()
            ->orderByDesc('date_of_join')
            ->pluck('date_of_join', 'date_of_join');
    
        // Set the latest DOJ as the default filter value
        $default_doj = $dates_of_join->first();
    
        // Get the filtered users based on the selected DOJ, or all if no filter is applied
        $users = User::when($request->date_of_join, function ($query) use ($request) {
            return $query->where('date_of_join', $request->date_of_join);
        }, function ($query) use ($default_doj) {
            return $query->where('date_of_join', $default_doj);
        })->get();
    
        // Define the list of post test IDs to display
        $postTestIds = [13, 14, 15, 20, 19, 16, 17, 21, 22, 18];
    
        // Get the PostTest records filtered by the specific IDs and ordered
        $postTests = PostTest::whereIn('id', $postTestIds)
            ->orderByRaw("FIELD(id, " . implode(',', $postTestIds) . ")")
            ->get();
    
        // Get all PostTestResults for the filtered post tests and group them by post_test_id and user_id
        $postTestResults = PostTestResult::whereIn('post_test_id', $postTestIds)
            ->whereIn('type', ['post', 'remed1', 'remed2'])
            ->get()
            ->groupBy(['post_test_id', 'user_id']);
    
        // Map the post tests and attach results for each user
        $postTests = $postTests->map(function ($postTest) use ($postTestResults, $users) {
            $userResults = $users->map(function ($user) use ($postTest, $postTestResults) {
                $results = $postTestResults->get($postTest->id, collect())->get($user->id, collect());
    
                $postGrade = $results->firstWhere('type', 'post');
                $remed1Grade = $results->firstWhere('type', 'remed1');
                $remed2Grade = $results->firstWhere('type', 'remed2');
    
                // Determine if the user passed based on grades
                $status = 'Failed';
                if (($postGrade && $postGrade->grade > 70) || ($remed1Grade && $remed1Grade->grade > 70)) {
                    $status = 'Passed';
                }
    
                // Adjust grades for remedials to 70 if they are higher
                $adjustedRemed1Grade = $remed1Grade && $remed1Grade->grade > 70 ? 70 : ($remed1Grade ? $remed1Grade->grade : '0');
                $adjustedRemed2Grade = $remed2Grade && $remed2Grade->grade > 70 ? 70 : ($remed2Grade ? $remed2Grade->grade : '0');
    
                return [
                    'user' => $user,
                    'status' => $status,
                    'grades' => [
                        'post' => $postGrade ? $postGrade->grade : 'N/A',
                        'remed1' => $adjustedRemed1Grade,
                        'remed2' => $adjustedRemed2Grade,
                    ],
                ];
            });
    
            return [
                'postTest' => $postTest,
                'userResults' => $userResults,
            ];
        });
    
        return view('pages.manager.training_stages.induction_training', compact('users', 'dates_of_join', 'default_doj', 'postTests'));
    }
    

    


}
