<?php

namespace App\Http\Controllers\rekap;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PostTest;
use App\Models\PostTestResult;
use App\Models\User;

class RekapInductionTrainingController extends Controller
{
    public function index(Request $request)
    {
        // Get distinct dates of join and order them by the latest
        $dates_of_join = User::select('date_of_join')
            ->distinct()
            ->orderByDesc('date_of_join')
            ->pluck('date_of_join');

        // Set the latest DOJ as the default filter value
        $default_doj = $dates_of_join->first() ?? null;

        // Get the filtered users based on the selected DOJ, or all if no filter is applied
        $usersQuery = User::query();
        if ($request->date_of_join) {
            $usersQuery->where('date_of_join', $request->date_of_join);
        } elseif ($default_doj) {
            $usersQuery->where('date_of_join', $default_doj);
        }
        $users = $usersQuery->get();

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

                $postGrade = optional($results->firstWhere('type', 'post'))->grade;
                $remed1Grade = optional($results->firstWhere('type', 'remed1'))->grade;
                $remed2Grade = optional($results->firstWhere('type', 'remed2'))->grade;

                // Determine if the user passed based on grades
                $status = 'Failed';
                if (($postGrade && $postGrade > 70) || ($remed1Grade && $remed1Grade > 70)) {
                    $status = 'Passed';
                }

                // Adjust grades for remedials to 70 if they are higher
                $adjustedRemed1Grade = $remed1Grade > 70 ? 70 : ($remed1Grade ?? '0');
                $adjustedRemed2Grade = $remed2Grade > 70 ? 70 : ($remed2Grade ?? '0');

                return [
                    'user' => $user,
                    'status' => $status,
                    'grades' => [
                        'post' => $postGrade ?? 'N/A',
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

        return view('pages.admin.rekap_training_stages.induction_training', compact('users', 'dates_of_join', 'default_doj', 'postTests'));
    }
}
