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
    public function edit(Category $category)
    {
        if ($category->is_disabled) {
            return redirect()->route('categories.show')->with('error', 'This category is disabled and cannot be edited.');
        }
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        if ($category->is_disabled) {
            return redirect()->route('categories.show')->with('error', 'This category is disabled and cannot be updated.');
        }
        // Proceed with update logic...
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        if ($category->is_disabled) {
            return redirect()->route('categories.show')->with('error', 'This category is disabled and cannot be deleted.');
        }
        $category->delete();
        return redirect()->route('categories.show')->with('success', 'Category deleted successfully!');
    }


    public function toggleStatus(Category $category)
    {
        $category->is_active = !$category->is_active;
        $category->save();

        return redirect()->route('categories.show')->with('success', 'Category status updated successfully!');
    }

}
