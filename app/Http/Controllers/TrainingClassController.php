<?php

namespace App\Http\Controllers;

use App\Models\TrainingClass;
use App\Models\TrainingModule;
use App\Models\TrainingStage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;

class TrainingClassController extends Controller
{
    public function index(): View
    {
        $trainingClasses = TrainingClass::with(['instructor', 'trainingStage'])->get();
        return view('pages.admin.TrainingClass.index', compact('trainingClasses'));
    }

    public function create(): View
    {
        $instructors = User::where('role', 'trainer')->get();
        $trainingStages = TrainingStage::all();
        return view('pages.admin.TrainingClass.create', compact('instructors', 'trainingStages'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'instructor_id' => 'required|exists:users,id',
            'training_stage_id' => 'required|exists:training_stages,id',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image upload
        ]);
    
        $imagePath = null;
    
        if ($request->hasFile('banner_image')) {
            // Store the uploaded image and get its path
            $imagePath = $request->file('banner_image')->store('training_classes', 'public');
        }
    
        TrainingClass::create([
            'name' => $request->name,
            'description' => $request->description,
            'instructor_id' => $request->instructor_id,
            'training_stage_id' => $request->training_stage_id,
            'banner_image' => $imagePath, // Store the image path
        ]);
    
        return redirect()->route('trainingClasses.index')->with('success', 'Training class created successfully.');
    }
    

    public function show(TrainingClass $trainingClass): View
    {
        $trainingModules = $trainingClass->trainingModules()->with('creator')->get();
        return view('pages.admin.TrainingClass.show', compact('trainingClass', 'trainingModules'));
    }

    public function edit(TrainingClass $trainingClass): View
    {
        $instructors = User::where('role', 'trainer')->get();
        $trainingStages = TrainingStage::all();
        return view('pages.admin.TrainingClass.edit', compact('trainingClass', 'instructors', 'trainingStages'));
    }

    public function update(Request $request, TrainingClass $trainingClass): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'instructor_id' => 'required|exists:users,id',
            'training_stage_id' => 'required|exists:training_stages,id',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image upload
        ]);
    
        $imagePath = $trainingClass->banner_image;
    
        if ($request->hasFile('banner_image')) {
            // Delete the old image if it exists
            if ($imagePath) {
                \Storage::disk('public')->delete($imagePath);
            }
            // Store the new image and get its path
            $imagePath = $request->file('banner_image')->store('training_classes', 'public');
        }
    
        $trainingClass->update([
            'name' => $request->name,
            'description' => $request->description,
            'instructor_id' => $request->instructor_id,
            'training_stage_id' => $request->training_stage_id,
            'banner_image' => $imagePath, // Update the image path
        ]);
    
        return redirect()->route('trainingClasses.index')->with('success', 'Training class updated successfully.');
    }
    

    public function destroy(TrainingClass $trainingClass): RedirectResponse
    {
        try {
            $trainingClass->delete();
            return redirect()->route('trainingClasses.index')->with('success', 'Training class deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('trainingClasses.index')->with('error', 'Failed to delete training class.');
        }
    }

}
