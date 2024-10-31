<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\HikingTrail;
use Illuminate\Http\Request;


class HikingTrailController extends Controller
{
    public function index() {
        $trails = HikingTrail::with('categories')->get();

        return view('admin.trails.show', ['trails' => $trails]);
    }

    public function create()
    {
        // Fetch all categories
        $categories = Category::all();

        // Pass the categories to the view
        return view('admin.trails.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validate the input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'difficulty' => 'required|integer|min:1|max:5',
            'type_trail' => 'required|string|max:255',
            'categories' => 'required|array', // Ensure category is selected
        ]);

        $trail = HikingTrail::create($validated);
        $trail->categories()->attach($request->categories);

        // Redirect to the index page or show a success message
        return redirect()->route('trails.show')->with('success', 'Hiking trail created successfully!');
    }

    // Show the form to edit the specified hiking trail
    public function edit(HikingTrail $hikingTrail)
    {
        // Fetch all categories
        $categories = Category::all();

        // Fetch the current categories associated with this hiking trail
        $selectedCategories = $hikingTrail->categories->pluck('id')->toArray();

        // Pass the trail, all categories, and the selected categories to the view
        return view('admin.trails.edit', compact('hikingTrail', 'categories', 'selectedCategories'));
    }

    // Update the specified hiking trail in the database
    public function update(Request $request, HikingTrail $hikingTrail)
    {
        // Validate the input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'difficulty' => 'required|integer|min:1|max:5',
            'type_trail' => 'required|string|max:255',
            'categories' => 'required|array', // Ensure categories are provided
        ]);

        // Update the hiking trail
        $hikingTrail->update($validated);

        // Sync the selected categories (removes any existing ones and attaches the new ones)
        $hikingTrail->categories()->sync($request->categories);

        // Redirect back or show success message
        return redirect()->route('hiking_trails.index')->with('success', 'Hiking trail updated successfully!');
    }

    public function destroy($id)
    {
        // Find the hiking trail by ID and delete it
        $trail = HikingTrail::findOrFail($id);
        $trail->delete();

        // Redirect back with a success message
        return redirect()->route('trails.show')->with('success', 'Hiking Trail deleted successfully!');
    }
}
