<?php

namespace App\Http\Controllers\Student;

use App\Models\PostTestResult;
use App\Models\PostTest;
use App\Models\PostTestAnswer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentPostTestController extends Controller
{
    /**
     * Display the list of available post tests for the student.
     */
    public function index()
    {
        // Mendapatkan semua PostTest dengan relasi results dan questions
        $postTests = PostTest::with(['results', 'trainingStage'])
            ->get()
            ->map(function ($postTest) {
                // Ambil hasil percobaan pertama, kedua, atau ketiga untuk user yang sedang login
                $results = $postTest->results->where('user_id', auth()->id())->sortByDesc('created_at');
                $resultLabel = 'No Result';
                $score = 0;
                $percentage = 0;
                $resultType = 'N/A';
    
                // Tentukan label dan skor sesuai jenis percobaan
                if ($results->isNotEmpty()) {
                    $latestResult = $results->first();
    
                    if ($latestResult->type == 'remed2') {
                        $resultLabel = 'Remedial 2';
                        $score = $latestResult->score;
                        $resultType = 'Remedial 2';
                    } elseif ($latestResult->type == 'remed1') {
                        $resultLabel = 'Remedial 1';
                        $score = $latestResult->score;
                        $resultType = 'Remedial 1';
                    } else {
                        $resultLabel = 'Post Test';
                        $score = $latestResult->score;
                        $resultType = 'Post Test';
                    }
    
                    // Hitung persentase hasil
                    $totalQuestions = $postTest->questions->count();
                    $percentage = $totalQuestions > 0 ? ($score / $totalQuestions) * 100 : 0;
                }
    
                // Format label result dan persentase dengan dua angka desimal
                $postTest->resultLabel = $resultLabel . ': ' . number_format($percentage, 2) . '%';
                $postTest->score = $score;
                $postTest->percentage = $percentage;
                $postTest->resultType = $resultType;
    
                // Periksa validasi waktu
                $currentTime = \Carbon\Carbon::now('Asia/Jakarta'); // Waktu sekarang dalam zona waktu yang tepat
                $startTime = \Carbon\Carbon::parse($postTest->start_time)->setTimezone('Asia/Jakarta'); // Waktu mulai
                $endTime = \Carbon\Carbon::parse($postTest->end_time)->setTimezone('Asia/Jakarta'); // Waktu selesai
    
            
                // Validasi waktu untuk tombol Take
                $postTest->isValidTime = $currentTime->greaterThanOrEqualTo($startTime) && $currentTime->lessThanOrEqualTo($endTime);
    
                // Jika sudah lewat waktu akhir, tombol take harus nonaktif
                if ($currentTime->greaterThanOrEqualTo($endTime)) {
                    $postTest->isValidTime = false;
                }
    
                return $postTest;
            });
    
        return view('pages.student.postTest.index', compact('postTests'));
    }
    
    
    /**
     * Show the form to take a post test.
     */
    public function take(PostTest $postTest)
    {
        // Get questions related to the post test
        $questions = $postTest->questions;
    
        // Return the view with $postTest and $questions variables
        return view('pages.student.postTest.take', compact('postTest', 'questions'));
    }

    /**
     * Submit the answers for a post test.
     */
    public function submitPostTest(Request $request, $postTest)
    {
        // Ambil data post test beserta pertanyaannya
        $postTest = PostTest::with('questions')->findOrFail($postTest);

        // Ambil percobaan sebelumnya berdasarkan user dan post test
        $existingAttempts = PostTestAnswer::where('user_id', auth()->id())
            ->whereHas('postTestQuestion', function ($query) use ($postTest) {
                $query->where('post_test_id', $postTest->id);
            })
            ->pluck('type') // Ambil semua tipe percobaan sebelumnya
            ->unique(); // Hindari duplikasi tipe percobaan

        // Tentukan tipe percobaan
        $attemptType = match ($existingAttempts->count()) {
            0 => 'post',     // Percobaan pertama
            1 => 'remed1',   // Percobaan kedua
            2 => 'remed2',   // Percobaan ketiga
            default => 'remed2', // Lebih dari tiga percobaan
        };

        \Log::info('Existing Attempts: ', ['attempts' => $existingAttempts, 'type' => $attemptType]);

        // Proses jawaban siswa
        $userAnswers = $request->input('answers');
        $correctAnswersCount = 0;

        foreach ($postTest->questions as $question) {
            $correctAnswer = $question->correct_answer;
            // If no answer is provided, set to 'N/A'
            $studentAnswerId = $userAnswers[$question->id] ?? 'N/A'; 
            $isCorrect = ($studentAnswerId !== 'N/A' && $studentAnswerId === $correctAnswer); // Only check correctness if answer is not 'N/A'

            if ($isCorrect) {
                $correctAnswersCount++;
            }

            // Simpan jawaban user
            PostTestAnswer::create([
                'user_id' => auth()->id(),
                'post_test_question_id' => $question->id,
                'answer' => $studentAnswerId,
                'is_correct' => $isCorrect,
                'type' => $attemptType, // Simpan tipe percobaan
            ]);
        }

        // Hitung skor
        $totalQuestions = $postTest->questions->count();
        $score = $correctAnswersCount;

        // Hitung grade sebagai persentase
        $grade = ($totalQuestions > 0) ? round(($correctAnswersCount / $totalQuestions) * 100) : 0;

        // Simpan hasil post-test dengan tipe yang benar
        PostTestResult::create([
            'user_id' => auth()->id(),
            'post_test_id' => $postTest->id,
            'score' => $score,
            'grade' => $grade,  // Simpan grade sebagai nilai persen (misal, 70 bukan 70%)
            'is_passed' => $grade >= 60, // Periksa apakah lulus berdasarkan grade
            'attempted_on' => now(),
            'type' => $attemptType, // Simpan tipe percobaan yang benar
        ]);

        \Log::info('PostTestResult Created: ', [
            'user_id' => auth()->id(),
            'post_test_id' => $postTest->id,
            'type' => $attemptType,
            'grade' => $grade,
        ]);

        // Redirect ke halaman hasil post-test
        return redirect()->route('student.post_tests.result', ['postTest' => $postTest->id]);
    }




    public function result(PostTest $postTest)
    {
        // Ambil semua hasil percobaan untuk user terkait dengan post test tertentu
        $results = PostTestResult::where('user_id', auth()->id())
            ->where('post_test_id', $postTest->id)
            ->get();

        // Jika tidak ada hasil, redirect atau tampilkan pesan error
        if ($results->isEmpty()) {
            return redirect()->route('student.post_tests.index')->with('error', 'No result found for this test.');
        }

        // Ambil jumlah total pertanyaan untuk post test ini
        $totalQuestions = $postTest->questions->count();

        // Hitung persentase dan tentukan status lulus berdasarkan percobaan
        $percentage = 0;
        $isPassed = false;
        $latestResult = $results->last();  // Ambil hasil percobaan terakhir

        foreach ($results as $result) {
            $score = $result->score;
            $percentage = $totalQuestions > 0 ? ($score / $totalQuestions) * 100 : 0;
            
            // Tentukan apakah lulus atau tidak berdasarkan nilai
            if ($percentage > 70) {
                $isPassed = true;
                break; // Jika sudah ada yang lulus, tidak perlu lanjutkan pengecekan
            }
        }

        // Tentukan status berdasarkan percobaan terakhir
        $status = $isPassed ? 'Passed' : 'Failed';
        $statusClass = $isPassed ? 'alert-success' : 'alert-danger';

        return view('pages.student.postTest.result', compact('results', 'postTest', 'totalQuestions', 'percentage', 'status', 'statusClass', 'latestResult'));
    }

}




