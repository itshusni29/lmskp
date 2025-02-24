<?php

namespace App\Http\Controllers\spv;

use App\Http\Controllers\Controller;
use App\Models\ApprovalSpvTraining;
use App\Models\User;
use App\Models\PostTest;
use App\Models\PostTestResult;
use Illuminate\Http\Request;

class LocalTrainingCenterController extends Controller
{
    public function index(Request $request)
    {
        // Ambil daftar tanggal unik "date_of_join" dan urutkan berdasarkan yang terbaru
        $datesOfJoin = User::select('date_of_join')
            ->distinct()
            ->orderByDesc('date_of_join')
            ->pluck('date_of_join');
    
        // Tetapkan default date_of_join (tanggal terbaru)
        $defaultDoj = $datesOfJoin->first();
    
        // Ambil date_of_join yang dipilih atau gunakan default
        $selectedDateOfJoin = $request->get('date_of_join', $defaultDoj);
    
        // Ambil daftar pengguna berdasarkan date_of_join
        $users = User::where('date_of_join', $selectedDateOfJoin)->get();
    
        // Jika tidak ada user, langsung return view tanpa post test data
        if ($users->isEmpty()) {
            return view('pages.spv.training_stages.local_training_center', [
                'users' => $users,
                'datesOfJoin' => $datesOfJoin,
                'defaultDoj' => $defaultDoj,
                'postTestsData' => [],
            ]);
        }
    
        // Ambil semua PostTest yang sesuai dengan user berdasarkan LTC
        $localTrainingStageId = 2;
        $postTests = PostTest::where('training_stage_id', $localTrainingStageId)
            ->whereIn('ltc', $users->pluck('ltc'))
            ->orderBy('id')
            ->get();
    
        // Ambil hasil PostTest hanya untuk user yang ada dalam daftar
        $postTestResults = PostTestResult::whereIn('post_test_id', $postTests->pluck('id')->toArray())
            ->whereIn('user_id', $users->pluck('id')->toArray())
            ->whereIn('type', ['post', 'remed1', 'remed2'])
            ->get()
            ->groupBy(['post_test_id', 'user_id']);
    
        // Proses data untuk setiap user
        $postTestsData = $users->map(function ($user) use ($postTests, $postTestResults) {
            $userPostTests = $postTests->filter(fn ($pt) => $pt->ltc === $user->ltc);
    
            $userResults = $userPostTests->map(function ($postTest) use ($postTestResults, $user) {
                $results = optional($postTestResults->get($postTest->id))->get($user->id, collect());
                
                $postGrade = $results?->firstWhere('type', 'post');
                $remed1Grade = $results?->firstWhere('type', 'remed1');
                $remed2Grade = $results?->firstWhere('type', 'remed2');
                
                $status = 'Failed';
                if (($postGrade && $postGrade->grade >= 70) || ($remed1Grade && $remed1Grade->grade >= 70) || ($remed2Grade && $remed2Grade->grade >= 70)) {
                    $status = 'Passed';
                }
    
                $adjustedRemed1Grade = $remed1Grade && $remed1Grade->grade > 70 ? 70 : ($remed1Grade?->grade ?? '0');
                $adjustedRemed2Grade = $remed2Grade && $remed2Grade->grade > 70 ? 70 : ($remed2Grade?->grade ?? '0');
    
                return [
                    'postTest' => $postTest,
                    'grades' => [
                        'post' => $postGrade?->grade ?? 'N/A',
                        'remed1' => $adjustedRemed1Grade,
                        'remed2' => $adjustedRemed2Grade,
                    ],
                    'status' => $status,
                ];
            });
    
            return [
                'user' => $user,
                'postTests' => $userResults,
            ];
        });
    
        return view('pages.spv.training_stages.local_training_center', [
            'users' => $users,
            'datesOfJoin' => $datesOfJoin,
            'defaultDoj' => $defaultDoj,
            'postTestsData' => $postTestsData,
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
                'training_stage_id' => 2,
            ],
            [
                'spv_training_id' => auth()->id(),
                'approval_status' => $validated['approval_status'],
                'remark' => $validated['remark'] ?? null,
            ]
        );
    
        return back()->with('success', 'Approval successfully updated!');
    }
}
