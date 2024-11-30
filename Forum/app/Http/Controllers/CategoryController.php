<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function showCreateForm()
{
    $categories = Category::all();
    return view('posts.create', compact('categories'));
}

    public function listAllCategories()
    {
        $categories = Category::all();
        return view('category.listAllCategory', ['categories' => $categories]);
    }

    public function listCreateCategory()
    {
        $categories = Category::all(); // Busca todas as categorias do banco
        return view('category.createCategory', ['categories' => $categories]);
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
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            
        ]);

        $category = Category::findOrFail($id);
        $category->title = $request->title;
        $category->description = $request->description;
        
        $category->save();

        return redirect()->route('listAllCategories')->with('success', 'Category updated successfully');
    }

    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        

        return redirect()->route('listAllCategories')->with('success', 'Category deleted successfully');
    }
}