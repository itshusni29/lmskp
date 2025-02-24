<?php

namespace App\Http\Controllers;

use App\Models\PostTest;
use App\Models\PostTestResult;
use App\Models\User;
use Illuminate\Http\Request;

class PostTestResultController extends Controller
{
    /**
     * Display a listing of the post test results.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $postTestResults = PostTestResult::with('user', 'postTest')->get();
        return view('pages.admin.postTestResult.index', compact('postTestResults'));
    }

    /**
     * Show the form for creating a new post test result.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $users = User::all();  // Retrieve all users for dropdown
        $postTests = PostTest::all();  // Retrieve all post tests for dropdown
        return view('pages.admin.postTestResult.create', compact('users', 'postTests'));
    }

    /**
     * Store a newly created post test result in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'post_test_id' => 'required|exists:post_tests,id',
            'score' => 'required|numeric',
            'is_passed' => 'required|boolean',
            'attempted_on' => 'nullable|date',
        ]);

        PostTestResult::create([
            'user_id' => $request->user_id,
            'post_test_id' => $request->post_test_id,
            'score' => $request->score,
            'is_passed' => $request->is_passed,
            'attempted_on' => $request->attempted_on,
        ]);

        return redirect()->route('postTestResults.index')->with('success', 'PostTest result created successfully.');
    }

    /**
     * Display the specified post test result.
     *
     * @param  \App\Models\PostTestResult  $postTestResult
     * @return \Illuminate\View\View
     */
    public function show(PostTestResult $postTestResult)
    {
        return view('pages.admin.postTestResult.show', compact('postTestResult'));
    }

    /**
     * Show the form for editing the specified post test result.
     *
     * @param  \App\Models\PostTestResult  $postTestResult
     * @return \Illuminate\View\View
     */
    public function edit(PostTestResult $postTestResult)
    {
        $users = User::all();  // Retrieve all users for dropdown
        $postTests = PostTest::all();  // Retrieve all post tests for dropdown
        return view('pages.admin.postTestResult.edit', compact('postTestResult', 'users', 'postTests'));
    }

    /**
     * Update the specified post test result in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PostTestResult  $postTestResult
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, PostTestResult $postTestResult)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'post_test_id' => 'required|exists:post_tests,id',
            'score' => 'required|numeric',
            'is_passed' => 'required|boolean',
            'attempted_on' => 'nullable|date',
        ]);

        $postTestResult->update([
            'user_id' => $request->user_id,
            'post_test_id' => $request->post_test_id,
            'score' => $request->score,
            'is_passed' => $request->is_passed,
            'attempted_on' => $request->attempted_on,
        ]);

        return redirect()->route('postTestResults.index')->with('success', 'PostTest result updated successfully.');
    }

    /**
     * Remove the specified post test result from storage.
     *
     * @param  \App\Models\PostTestResult  $postTestResult
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(PostTestResult $postTestResult)
    {
        $postTestResult->delete();
        return redirect()->route('postTestResults.index')->with('success', 'PostTest result deleted successfully.');
    }
}
