<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use App\Models\TrainingClass;
use App\Models\TrainingStage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class TrainerTrainingClassController extends Controller
{
    // Menampilkan daftar kelas pelatihan untuk instruktur yang sedang login
    public function index()
    {
        $trainingClasses = TrainingClass::with(['instructor', 'trainingStage'])
            ->where('instructor_id', Auth::id()) // Menampilkan hanya kelas yang diajarkan oleh trainer ini
            ->get();
        
        return view('pages.trainer.TrainingClass.index', compact('trainingClasses'));
    }

    // Menampilkan form untuk membuat kelas pelatihan baru
    public function create()
    {
        $trainingStages = TrainingStage::all();
        return view('pages.trainer.TrainingClass.create', compact('trainingStages'));
    }

    // Menyimpan kelas pelatihan baru
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'training_stage_id' => 'required|exists:training_stages,id',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $imagePath = null;
    
        if ($request->hasFile('banner_image')) {
            $imagePath = $request->file('banner_image')->store('training_classes', 'public');
        }

        TrainingClass::create([
            'name' => $request->name,
            'description' => $request->description,
            'instructor_id' => Auth::id(), // Menggunakan ID instruktur yang sedang login
            'training_stage_id' => $request->training_stage_id,
            'banner_image' => $imagePath,
        ]);
    
        return redirect()->route('trainer.trainingClasses.index')->with('success', 'Training class created successfully.');
    }

    // Menampilkan detail kelas pelatihan
    public function show(TrainingClass $trainingClass)
    {
        return view('pages.trainer.TrainingClass.show', compact('trainingClass'));
    }

    // Menampilkan form edit kelas pelatihan
    public function edit(TrainingClass $trainingClass)
    {
        $trainingStages = TrainingStage::all();
        return view('pages.trainer.TrainingClass.edit', compact('trainingClass', 'trainingStages'));
    }

    // Memperbarui kelas pelatihan
    public function update(Request $request, TrainingClass $trainingClass): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'training_stage_id' => 'required|exists:training_stages,id',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $imagePath = $trainingClass->banner_image;
    
        if ($request->hasFile('banner_image')) {
            if ($imagePath) {
                \Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('banner_image')->store('training_classes', 'public');
        }
    
        $trainingClass->update([
            'name' => $request->name,
            'description' => $request->description,
            'training_stage_id' => $request->training_stage_id,
            'banner_image' => $imagePath,
        ]);
    
        return redirect()->route('trainer.trainingClasses.index')->with('success', 'Training class updated successfully.');
    }

    // Menghapus kelas pelatihan
    public function destroy(TrainingClass $trainingClass): RedirectResponse
    {
        $trainingClass->delete();
        return redirect()->route('trainer.trainingClasses.index')->with('success', 'Training class deleted successfully.');
    }
}
