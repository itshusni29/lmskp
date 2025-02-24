<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\TrainingStage;
use Illuminate\Support\Facades\Auth;


class StudentController extends Controller
{
    /**
     * Show the student dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        // Fetch all training stages for the student dashboard
        $trainingStages = TrainingStage::all();

        // Pass the training stages to the view
        return view('pages.student.dashboard', compact('trainingStages'));
    }

    /**
     * Show a specific training stage and its related classes.
     *
     * @param TrainingStage $trainingStage
     * @return \Illuminate\View\View
     */
    public function showTrainingStage(TrainingStage $trainingStage)
    {
        // Eager load the trainingClasses relationship
        $trainingStage->load('trainingClasses');

        // Log the training classes data to check if it's loaded correctly
        logger($trainingStage->trainingClasses); // This logs the training classes data for debugging

        // Pass the training stage and its related classes to the view
        return view('pages.student.TrainingStage.show', compact('trainingStage'));
    }

        /**
     * Show the profile of the logged-in user.
     *
     * @return \Illuminate\View\View
     */
    public function profile()
    {
        $user = Auth::user();
        return view('pages.student.users.show', compact('user'));
    }
    
}
