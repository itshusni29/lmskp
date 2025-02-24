<?php

namespace App\Http\Controllers;

use App\Models\PostTest;
use App\Models\PostTestQuestion;
use Illuminate\Http\Request;

class PostTestQuestionController extends Controller
{
    /**
     * Display a listing of the post test questions.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $questions = PostTestQuestion::with('postTest')->get();
        return view('pages.admin.postTestQuestion.index', compact('questions'));
    }

    /**
     * Show the form for creating a new post test question.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $postTests = PostTest::all();  // Retrieve all post tests for dropdown
        return view('pages.admin.postTestQuestion.create', compact('postTests'));
    }

    /**
     * Store a newly created post test question in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'post_test_id' => 'required|exists:post_tests,id',
            'question' => 'required|string',
            'option_a' => 'required|string',
            'option_b' => 'required|string',
            'option_c' => 'required|string',
            'option_d' => 'required|string',
            'correct_answer' => 'required|string',
        ]);

        PostTestQuestion::create([
            'post_test_id' => $request->post_test_id,
            'question' => $request->question,
            'option_a' => $request->option_a,
            'option_b' => $request->option_b,
            'option_c' => $request->option_c,
            'option_d' => $request->option_d,
            'correct_answer' => $request->correct_answer,
        ]);

        return redirect()->route('postTestQuestions.index')->with('success', 'PostTest Question created successfully.');
    }

    /**
     * Display the specified post test question.
     *
     * @param  \App\Models\PostTestQuestion  $postTestQuestion
     * @return \Illuminate\View\View
     */
    public function show(PostTestQuestion $postTestQuestion)
    {
        return view('pages.admin.postTestQuestion.show', compact('postTestQuestion'));
    }

    /**
     * Show the form for editing the specified post test question.
     *
     * @param  \App\Models\PostTestQuestion  $postTestQuestion
     * @return \Illuminate\View\View
     */
    public function edit(PostTestQuestion $postTestQuestion)
    {
        $postTests = PostTest::all();  // Retrieve all post tests for dropdown
        return view('pages.admin.postTestQuestion.edit', compact('postTestQuestion', 'postTests'));
    }

    /**
     * Update the specified post test question in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PostTestQuestion  $postTestQuestion
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, PostTestQuestion $postTestQuestion)
    {
        $request->validate([
            'post_test_id' => 'required|exists:post_tests,id',
            'question' => 'required|string',
            'option_a' => 'required|string',
            'option_b' => 'required|string',
            'option_c' => 'required|string',
            'option_d' => 'required|string',
            'correct_answer' => 'required|string',
        ]);

        $postTestQuestion->update([
            'post_test_id' => $request->post_test_id,
            'question' => $request->question,
            'option_a' => $request->option_a,
            'option_b' => $request->option_b,
            'option_c' => $request->option_c,
            'option_d' => $request->option_d,
            'correct_answer' => $request->correct_answer,
        ]);

        return redirect()->route('postTestQuestions.index')->with('success', 'PostTest Question updated successfully.');
    }

    /**
     * Remove the specified post test question from storage.
     *
     * @param  \App\Models\PostTestQuestion  $postTestQuestion
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(PostTestQuestion $postTestQuestion)
    {
        $postTestQuestion->delete();
        return redirect()->route('postTestQuestions.index')->with('success', 'PostTest Question deleted successfully.');
    }
}
