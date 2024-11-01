<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\HikingTrail;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request) {
        $query = Category::with('hikingtrails');

        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $categories = $query->get();

        return view('admin.categories.show', [
            'categories' => $categories
        ]);
    }


    public function create()
    {
        // Pass the categories to the view
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        // Validate the input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::create($validated);

        // Redirect to the index page or show a success message
        return redirect()->route('categories.show')->with('success', 'Category created successfully!');
    }

    // Show the form to edit the specified hiking trail
    public function edit(Category $category)
    {

        // Pass the trail, all categories, and the selected categories to the view
        return view('admin.categories.edit', compact('category'));
    }

    // Update the specified category in the database
    public function update(Request $request, Category $category)
    {
        // Validate the input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Update the hiking trail
        $category->update($validated);
        // Redirect back or show success message
        return redirect()->route('categories.show')->with('success', 'Category updated successfully!');
    }

    public function destroy($id)
    {
        // Find the hiking trail by ID and delete it
        $trail = Category::findOrFail($id);
        $trail->delete();

        // Redirect back with a success message
        return redirect()->route('categories.show')->with('success', 'Category deleted successfully!');
    }
}
