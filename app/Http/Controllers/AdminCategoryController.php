<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

class AdminCategoryController extends Controller
{
    public function index(){
        return view('dashboard.categories.index', [
            'categories' =>Category::all()
        ]);
    }
    public function create(){
        return view('dashboard.categories.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories',
            'color' => 'required|string|in:blue,red,green,yellow,purple,pink,indigo',
        ]);

        Category::create($request->only(['name', 'slug', 'color']));

        return redirect()->route('categories.index')
            ->with('success', 'Category "' . $request->name . '" created successfully!');
    }

    public function edit(Category $category){
        return view('dashboard.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category){
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug,'.$category->id,
            'color' => 'required|string|in:blue,red,green,yellow,purple,pink,indigo',
        ]);

        $category->update($request->only(['name', 'slug', 'color']));

        return redirect()->route('categories.index')
            ->with('update', 'Category "' . $request->name . '" updated successfully!');
    }
    public function destroy(Category $category){
        // Check if category has any posts
        if($category->posts()->count() > 0) {
            return redirect()->route('categories.index')
                ->with('error', 'Cannot delete category with associated posts');
        }
        $category->delete();
        
        return redirect()->route('categories.index')
            ->with('delete', 'Category "' . $category->name . '" deleted successfully!');
    }    
}
