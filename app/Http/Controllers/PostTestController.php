<?php

namespace App\Http\Controllers;

use App\Models\PostTest;
use App\Models\PostTestQuestion;
use App\Models\PostTestResult;
use App\Models\TrainingStage;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PostTestController extends Controller
{
    public function index()
    {
        $postTests = PostTest::all();
        return view('pages.admin.postTest.index', compact('postTests'));
    }

    public function create()
    {
        $trainingStages = TrainingStage::all();
        return view('pages.admin.postTest.create', compact('trainingStages'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'training_stage_id' => 'required|exists:training_stages,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'ltc' => 'required|in:aluminium,steel,common',
            'start_time' => 'nullable|date',
            'end_time' => 'nullable|date',
            'questions' => 'required|array',
            'questions.*.question' => 'required|string',
            'questions.*.option_a' => 'required|string',
            'questions.*.option_b' => 'required|string',
            'questions.*.option_c' => 'required|string',
            'questions.*.option_d' => 'required|string',
            'questions.*.correct_answer' => 'required|string|in:option_a,option_b,option_c,option_d',
        ]);

        // Simpan Post Test
        $postTest = PostTest::create([
            'training_stage_id' => $validated['training_stage_id'],
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'ltc' => $validated['ltc'], 
            'start_time' => $validated['start_time'] ?? null,
            'end_time' => $validated['end_time'] ?? null,
        ]);

        // Simpan Pertanyaan
        foreach ($validated['questions'] as $question) {
            $postTest->questions()->create($question);
        }

        return redirect()->route('post_tests.index')->with('success', 'Post Test berhasil dibuat!');
    }

    public function show(PostTest $postTest)
    {
        $results = PostTestResult::where('post_test_id', $postTest->id)
                                 ->with('user')
                                 ->get();

        $totalQuestions = $postTest->questions->count();

        $results->each(function ($result) use ($totalQuestions) {
            $result->percentage = $totalQuestions > 0 ? ($result->score / $totalQuestions) * 100 : 0;
            $result->isPassed = $result->percentage >= 70;
        });

        return view('pages.admin.postTest.show', compact('results', 'postTest', 'totalQuestions'));
    }

    public function edit($id)
    {
        $postTest = PostTest::with('questions')->findOrFail($id);
        $trainingStages = TrainingStage::all();
        return view('pages.admin.postTest.edit', compact('postTest', 'trainingStages'));
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming data
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
    
        // Parse the start and end time
        $startTime = $validatedData['start_time'] ? Carbon::parse($validatedData['start_time'], 'Asia/Jakarta') : null;
        $endTime = $validatedData['end_time'] ? Carbon::parse($validatedData['end_time'], 'Asia/Jakarta') : null;
    
        // Find the PostTest by ID
        $postTest = PostTest::findOrFail($id);
    
        // Update PostTest details
        $postTest->update([
            'training_stage_id' => $validatedData['training_stage_id'],
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'ltc' => $validatedData['ltc'], 
            'start_time' => $startTime,
            'end_time' => $endTime,
        ]);
    
        // Track the IDs of questions that are processed
        $processedQuestionIds = [];
    
        // Process each question in the validated data
        foreach ($validatedData['questions'] as $questionData) {
            if (!empty($questionData['id'])) {
                // If there's an ID, find the question and update its values
                $question = PostTestQuestion::findOrFail($questionData['id']);
    
                // Only update the content of the question, not the ID
                $question->update([
                    'question' => $questionData['question'],
                    'option_a' => $questionData['option_a'],
                    'option_b' => $questionData['option_b'],
                    'option_c' => $questionData['option_c'],
                    'option_d' => $questionData['option_d'],
                    'correct_answer' => $questionData['correct_answer'],
                ]);
    
                // Add the updated question ID to the processed list
                $processedQuestionIds[] = $question->id;
            } else {
                // If no ID exists, create a new question
                $newQuestion = $postTest->questions()->create([
                    'question' => $questionData['question'],
                    'option_a' => $questionData['option_a'],
                    'option_b' => $questionData['option_b'],
                    'option_c' => $questionData['option_c'],
                    'option_d' => $questionData['option_d'],
                    'correct_answer' => $questionData['correct_answer'],
                ]);
    
                // Add the new question ID to the processed list
                $processedQuestionIds[] = $newQuestion->id;
            }
        }
    
        // Delete questions that are not in the processed list (questions that were removed)
        $postTest->questions()->whereNotIn('id', $processedQuestionIds)->delete();
    
        // Return success message
        return redirect()->route('post_tests.index')->with('success', 'Post Test updated successfully!');
    }
    
            
    

    public function destroy(PostTest $postTest)
    {
        $postTest->questions()->delete();
        $postTest->delete();

        return redirect()->route('post_tests.index')->with('success', 'Post Test berhasil dihapus!');
    }
}
