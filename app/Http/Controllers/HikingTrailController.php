<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\HikingTrail;
use Illuminate\Http\Request;


class HikingTrailController extends Controller
{
    public function index(Request $request) {
        $query = HikingTrail::with('categories');

        // Search functionality
        if ($request->has('search') && $request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('location', 'like', '%' . $request->search . '%');
            });
        }

        // Filter by category
        if ($request->has('category') && $request->category) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('categories.id', $request->category); // Specificeer de tabel anders error.
            });
        }

        $trails = $query->get();
        $categories = Category::all(); // Voor de dropdown search

        return view('admin.trails.show', [
            'trails' => $trails,
            'categories' => $categories
        ]);
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
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'difficulty' => 'required|integer|min:1|max:5',
            'type_trail' => 'required|string|max:255',
            'categories' => 'required|array',
        ]);

        $validated['created_by'] = auth()->id(); // Save creator's ID

        $trail = HikingTrail::create($validated);
        $trail->categories()->attach($request->categories);

        return redirect()->route('trails.show')->with('success', 'Hiking trail created successfully!');
    }


    // Show the form to edit the specified hiking trail
    public function edit(HikingTrail $hikingTrail)
    {
        // Check if the logged-in user is the creator
        if (auth()->id() !== $hikingTrail->created_by) {
            abort(403, 'Unauthorized action.');
        }

        $categories = Category::all();
        $selectedCategories = $hikingTrail->categories->pluck('id')->toArray();

        return view('admin.trails.edit', compact('hikingTrail', 'categories', 'selectedCategories'));
    }

    public function update(Request $request, HikingTrail $hikingTrail)
    {
        if (auth()->id() !== $hikingTrail->created_by) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'difficulty' => 'required|integer|min:1|max:5',
            'type_trail' => 'required|string|max:255',
            'categories' => 'required|array',
        ]);

        $hikingTrail->update($validated);
        $hikingTrail->categories()->sync($request->categories);

        return redirect()->route('trails.show')->with('success', 'Hiking trail updated successfully!');
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
