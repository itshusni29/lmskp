<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use App\Models\TrainingModule;
use App\Models\TrainingClass;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;

class TrainerTrainingModuleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): View
    {
        $modules = TrainingModule::with('trainingClass', 'creator')
            ->where('creator_id', auth()->id())
            ->get();

        return view('pages.trainer.Module.index', compact('modules'));
    }

    public function create(): View
    {
        $trainingClasses = TrainingClass::all();
        return view('pages.trainer.Module.create', compact('trainingClasses'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'training_class_id' => 'required|exists:training_classes,id',
        ]);

        $imagePath = null;
        if ($request->hasFile('image_path')) {
            $imagePath = $request->file('image_path')->store('images/modules', 'public');
        }

        TrainingModule::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'image_path' => $imagePath,
            'training_class_id' => $validated['training_class_id'],
            'creator_id' => auth()->id(),
        ]);

        return redirect()->route('trainer.trainingModules.index')->with('success', 'Training module created successfully.');
    }

    public function edit(TrainingModule $trainingModule): View|RedirectResponse
    {
        if ($trainingModule->creator_id !== auth()->id()) {
            return redirect()->route('trainer.trainingModules.index')->with('error', 'You are not authorized to edit this module.');
        }

        $trainingClasses = TrainingClass::all();
        return view('pages.trainer.Module.edit', compact('trainingModule', 'trainingClasses'));
    }

    public function update(Request $request, TrainingModule $trainingModule): RedirectResponse
    {
        if ($trainingModule->creator_id !== auth()->id()) {
            return redirect()->route('trainer.trainingModules.index')->with('error', 'You are not authorized to update this module.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'training_class_id' => 'required|exists:training_classes,id',
        ]);

        if ($request->hasFile('image_path')) {
            if ($trainingModule->image_path) {
                Storage::delete('public/' . $trainingModule->image_path);
            }
            $trainingModule->image_path = $request->file('image_path')->store('images/modules', 'public');
        }

        $trainingModule->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'training_class_id' => $validated['training_class_id'],
        ]);

        return redirect()->route('trainer.trainingModules.index')->with('success', 'Training module updated successfully.');
    }

    public function destroy(TrainingModule $trainingModule): RedirectResponse
    {
        if ($trainingModule->creator_id !== auth()->id()) {
            return redirect()->route('trainingModules.index')->with('error', 'You are not authorized to delete this module.');
        }
    
        if ($trainingModule->image_path) {
            Storage::delete('public/' . $trainingModule->image_path);
        }
    
        $trainingModule->delete();
    
        return redirect()->route('trainingModules.index')->with('success', 'Training module deleted successfully.');
    }
    
    public function show(TrainingModule $trainingModule): View|RedirectResponse
    {
        if ($trainingModule->creator_id !== auth()->id()) {
            return redirect()->route('trainer.trainingModules.index')->with('error', 'You are not authorized to view this module.');
        }

        return view('pages.trainer.Module.show', compact('trainingModule'));
    }
}
