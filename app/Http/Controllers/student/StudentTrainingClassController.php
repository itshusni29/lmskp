<?php

namespace App\Http\Controllers\student;

use App\Models\TrainingClass;
use App\Models\TrainingStage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;  
use App\Models\TrainingModule;

class StudentTrainingClassController extends Controller
{


    // Show details of a specific training class
    public function show(TrainingClass $trainingClass): View
    {
        // Fetch the first module associated with the given training class
        $trainingModule = TrainingModule::where('training_class_id', $trainingClass->id)->first();

        // Pass the training class and its module to the view
        return view('pages.student.TrainingClass.show', compact('trainingClass', 'trainingModule'));
    }


}
