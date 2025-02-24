<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use App\Models\TrainingClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainerController extends Controller
{
    // Method to show the dashboard
    public function index()
    {
        // Get the training classes taught by the logged-in trainer
        $trainingClasses = TrainingClass::where('instructor_id', Auth::id())->get();
        
        // Count the total number of training classes
        $totalTrainingClasses = $trainingClasses->count();

        // Return the dashboard view with the data
        return view('pages.trainer.dashboard', compact('trainingClasses', 'totalTrainingClasses'));
    }
}
