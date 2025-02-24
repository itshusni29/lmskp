<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use App\Models\PostTest;
use App\Models\PostTestQuestion;
use App\Models\TrainingStage;
use App\Models\User;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TrainerPostTestController extends Controller
{
    public function index()
    {
        // Pastikan user yang sedang login adalah trainer
        if (Auth::user()->role !== 'trainer') {
            return redirect()->route('home')->with('error', 'Unauthorized access.');
        }
    
        // Ambil semua PostTest
        $postTests = PostTest::all(); // Tampilkan semua PostTest karena user adalah trainer
    
        return view('pages.trainer.postTest.index', compact('postTests'));
    }
    
    
    

    public function create()
    {
        $training_stage_id = TrainingStage::all();
        return view('pages.trainer.postTest.create', compact('training_stage_id'));
    }

    public function store(Request $request)
    {
        // Validate input
        $validatedData = $request->validate([
            'training_stage_id' => 'required|exists:training_classes,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'ltc' => 'required|in:aluminium,steel,common',
            'start_time' => 'nullable|date|before:end_time',
            'end_time' => 'nullable|date|after:start_time',
            'questions' => 'required|array|min:1',
            'questions.*.question' => 'required|string|max:255',
            'questions.*.option_a' => 'required|string|max:255',
            'questions.*.option_b' => 'required|string|max:255',
            'questions.*.option_c' => 'required|string|max:255',
            'questions.*.option_d' => 'required|string|max:255',
            'questions.*.correct_answer' => 'required|in:option_a,option_b,option_c,option_d',
        ]);

        // Save PostTest
        $postTest = PostTest::create([
            'training_stage_id' => $validatedData['training_stage_id'],
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'ltc' => $validatedData['ltc'], 
            'start_time' => $validatedData['start_time'],
            'end_time' => $validatedData['end_time'],
            // No need to store trainer_id as we are using role
        ]);

        // Save PostTestQuestions
        foreach ($validatedData['questions'] as $questionData) {
            PostTestQuestion::create([
                'post_test_id' => $postTest->id,
                'question' => $questionData['question'],
                'option_a' => $questionData['option_a'],
                'option_b' => $questionData['option_b'],
                'option_c' => $questionData['option_c'],
                'option_d' => $questionData['option_d'],
                'correct_answer' => $questionData['correct_answer'],
            ]);
        }

        return redirect()->route('trainer.postTests.index')->with('success', 'Post Test created successfully!');
    }

    public function show(PostTest $postTest)
    {
        // Ensure that only a trainer can see their post-tests
        $trainerRole = Auth::user()->role == 'trainer';
        if (!$trainerRole) {
            return redirect()->route('trainer.postTests.index')->with('error', 'Unauthorized access.');
        }

        return view('pages.trainer.postTest.show', compact('postTest'));
    }
    public function edit($id)
    {
        $postTest = PostTest::with('questions')->findOrFail($id);
        $trainingStages = TrainingStage::all();
        return view('pages.trainer.postTest.edit', compact('postTest', 'trainingStages'));
    }
 
    public function update(Request $request, $id)
{
    // Validasi data yang diterima
    $validatedData = $request->validate([
        'training_stage_id' => 'required|exists:training_stages,id',
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'ltc' => 'required|in:aluminium,steel,common',
        'start_time' => 'nullable|date|before:end_time',
        'end_time' => 'nullable|date|after:start_time',
        'questions' => 'required|array|min:1',
        'questions.*.id' => 'nullable|exists:post_test_questions,id',
        'questions.*.question' => 'required|string|max:255',
        'questions.*.option_a' => 'required|string|max:255',
        'questions.*.option_b' => 'required|string|max:255',
        'questions.*.option_c' => 'required|string|max:255',
        'questions.*.option_d' => 'required|string|max:255',
        'questions.*.correct_answer' => 'required|in:option_a,option_b,option_c,option_d',
    ]);

    // Cari PostTest berdasarkan ID
    $postTest = PostTest::findOrFail($id);

    // Konversi waktu menggunakan Carbon, hanya jika tidak null
    $startTime = !empty($validatedData['start_time']) ? Carbon::parse($validatedData['start_time'], 'Asia/Jakarta') : null;
    $endTime = !empty($validatedData['end_time']) ? Carbon::parse($validatedData['end_time'], 'Asia/Jakarta') : null;

    // Update data PostTest
    $postTest->update([
        'training_stage_id' => $validatedData['training_stage_id'],
        'name' => $validatedData['name'],
        'description' => $validatedData['description'],
        'ltc' => $validatedData['ltc'],
        'start_time' => $startTime,
        'end_time' => $endTime,
    ]);

    // Kumpulkan ID pertanyaan yang diproses
    $processedQuestionIds = [];

    foreach ($validatedData['questions'] as $questionData) {
        // Jika ada ID, perbarui; jika tidak, buat baru
        $question = $postTest->questions()->updateOrCreate(
            ['id' => $questionData['id'] ?? null], // Cari berdasarkan ID jika ada
            [
                'question' => $questionData['question'],
                'option_a' => $questionData['option_a'],
                'option_b' => $questionData['option_b'],
                'option_c' => $questionData['option_c'],
                'option_d' => $questionData['option_d'],
                'correct_answer' => $questionData['correct_answer'],
            ]
        );

        $processedQuestionIds[] = $question->id; // Simpan ID pertanyaan yang digunakan
    }

    // Hapus pertanyaan yang tidak digunakan
    $postTest->questions()->whereNotIn('id', $processedQuestionIds)->delete();

    return redirect()->route('trainer.postTests.index')->with('success', 'Post Test updated successfully!');
}




    public function destroy(PostTest $postTest)
    {
        // Ensure that only a trainer can delete their post-tests
        $trainerRole = Auth::user()->role == 'trainer';
        if (!$trainerRole) {
            return redirect()->route('trainer.postTests.index')->with('error', 'Unauthorized access.');
        }

        // Delete related questions and post test
        $postTest->questions()->delete();
        $postTest->delete();

        return redirect()->route('trainer.postTests.index')->with('success', 'Post Test deleted successfully!');
    }
}
















