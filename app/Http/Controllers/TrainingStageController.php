<?php

namespace App\Http\Controllers;

use App\Models\TrainingStage;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Storage;

class TrainingStageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index(): View|Factory
    {
        $trainingStages = TrainingStage::all(); // Fetch all training stages
        return view('pages.admin.training_stages.index', compact('trainingStages')); // Pass to the index view
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create(): View|Factory
    {
        return view('pages.admin.training_stages.create'); // Render the create form
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate image
        ]);

        // Handle the banner image upload if it exists
        if ($request->hasFile('banner_image')) {
            $path = $request->file('banner_image')->store('training_banners', 'public'); // Store the image
        } else {
            $path = null; // If no image, set path as null
        }

        // Create the new training stage with the validated data
        TrainingStage::create([
            'name' => $request->name,
            'description' => $request->description,
            'banner_image' => $path, // Save the image path
        ]);

        return redirect()->route('training_stages.index')->with('success', 'Training stage created successfully.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TrainingStage  $trainingStage
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function show(TrainingStage $trainingStage): View|Factory
    {
        return view('pages.admin.training_stages.show', compact('trainingStage')); // Render the detail view
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TrainingStage  $trainingStage
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit(TrainingStage $trainingStage): View|Factory
    {
        return view('pages.admin.training_stages.edit', compact('trainingStage')); // Render the edit form
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TrainingStage  $trainingStage
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, TrainingStage $trainingStage): RedirectResponse
    {
        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate image
        ]);

        // Handle the banner image upload if it exists
        if ($request->hasFile('banner_image')) {
            // Delete old image if exists
            if ($trainingStage->banner_image && Storage::disk('public')->exists($trainingStage->banner_image)) {
                Storage::disk('public')->delete($trainingStage->banner_image);
            }
            // Store new image and get the path
            $path = $request->file('banner_image')->store('training_banners', 'public');
        } else {
            // If no image is uploaded, keep the old one
            $path = $trainingStage->banner_image;
        }

        // Update the training stage with new data
        $trainingStage->update([
            'name' => $request->name,
            'description' => $request->description,
            'banner_image' => $path, // Update the image path
        ]);

        return redirect()->route('training_stages.index')->with('success', 'Training stage updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TrainingStage  $trainingStage
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(TrainingStage $trainingStage): RedirectResponse
    {
        // Delete the image if exists
        if ($trainingStage->banner_image && Storage::disk('public')->exists($trainingStage->banner_image)) {
            Storage::disk('public')->delete($trainingStage->banner_image);
        }

        // Delete the training stage record
        $trainingStage->delete();

        return redirect()->route('training_stages.index')->with('success', 'Training stage deleted successfully.');
    }
}
