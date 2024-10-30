<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategory;
use App\Http\Requests\updateCategory;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $rows = Category::where('parent_id', null)->paginate(10);
        return view('admin.categories.index', compact('rows'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(StoreCategory $request)
    {
        Category::create($request->validated());
        alert()->success('Category added successfully', 'Success');
        return redirect()->route('admin.categories.index');
    }

    public function edit(Category $category)
    {
        $row = $category;
        return view('admin.categories.edit', compact('row'));
    }

    public function update(updateCategory $request, Category $category)
    {
        $category->update($request->validated());
        alert()->success('Category updated successfully', 'Success');
        return redirect()->route('admin.categories.index');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully');
    }
}
