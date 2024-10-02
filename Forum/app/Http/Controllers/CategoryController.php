<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function listAllCategories()
    {
        $categories = Category::all();
        return view('category.listAllCategory', ['categories' => $categories]);
    }

    public function listCategoryById($id)
    {
        $category = Category::findOrFail($id);
        return view('category.listCategoryByid', ['category' => $category]);
    }

    public function createCategory(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        $category = Category::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('listAllCategories')->with('success', 'Category created successfully');
    }

    public function editCategory($id)
    {
        $category = Category::findOrFail($id);
        return view('category.editCategory');
    }

    public function updateCategory(Request $request, $id)
    {
        $request->validate([
            'id' => 'required|int|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);
    }

    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('listAllCategories')->with('success', 'Category deleted successfully');
    }
}