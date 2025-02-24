<?php

namespace App\Http\Controllers;

use App\Models\TrainingModule;
use App\Models\TrainingClass;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;

class TrainingModuleController extends Controller
{
    public function index(): View
    {
        $modules = TrainingModule::with('trainingClass', 'creator')->get();
        return view('pages.admin.Module.index', compact('modules'));
    }

    public function create(): View
    {
        $trainingClasses = TrainingClass::all();
        $users = User::all();
        return view('pages.admin.Module.create', compact('trainingClasses', 'users'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'training_class_id' => 'required|exists:training_classes,id',
            'creator_id' => 'required|exists:users,id',
        ]);

        $imagePath = null;
        if ($request->hasFile('image_path')) {
            $imagePath = $request->file('image_path')->store('images/modules', 'public');
        }

        TrainingModule::create([
            'title' => $request->title,
            'content' => $request->content,
            'image_path' => $imagePath,
            'training_class_id' => $request->training_class_id,
            'creator_id' => $request->creator_id,
        ]);

        return redirect()->route('trainingModules.index')->with('success', 'Training module created successfully.');
    }

    public function show(TrainingModule $trainingModule): View
    {
        return view('pages.admin.Module.show', compact('trainingModule'));
    }

    public function edit(TrainingModule $trainingModule): View
    {
        $trainingClasses = TrainingClass::all();
        $users = User::all();
        return view('pages.admin.Module.edit', compact('trainingModule', 'trainingClasses', 'users'));
    }


    public function update(Request $request, TrainingModule $trainingModule): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'training_class_id' => 'required|exists:training_classes,id',
            'creator_id' => 'required|exists:users,id',
        ]);

        // Check if a new image has been uploaded
        if ($request->hasFile('image_path')) {
            // Delete the old image if it exists
            if ($trainingModule->image_path) {
                Storage::delete('public/' . $trainingModule->image_path);
            }
            // Store the new image
            $imagePath = $request->file('image_path')->store('images/modules', 'public');
            $trainingModule->image_path = $imagePath;
        }

        // Update the module's details
        $trainingModule->update([
            'title' => $request->title,
            'content' => $request->content,
            'training_class_id' => $request->training_class_id,
            'creator_id' => $request->creator_id,
        ]);

        return redirect()->route('trainingModules.index')->with('success', 'Training module updated successfully.');
    }

    public function destroy(TrainingModule $trainingModule): RedirectResponse
    {
        // Delete the associated image if it exists
        if ($trainingModule->image_path) {
            Storage::delete('public/' . $trainingModule->image_path);
        }

        // Delete the training module
        $trainingModule->delete();
        return redirect()->route('trainingModules.index')->with('success', 'Training module deleted successfully.');
    }
}
