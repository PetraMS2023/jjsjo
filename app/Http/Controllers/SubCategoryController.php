<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategory;
use App\Http\Requests\StoreSubCategory;
use App\Http\Requests\updateCategory;
use App\Models\Category;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index()
    {
        $rows = Category::where('parent_id' , '!=' , null)->paginate(10);
        return view('admin.SubCategories.index', compact('rows'));
    }

    public function create()
    {
        $rows = Category::where('parent_id' , '=' , null)->get();
        return view('admin.SubCategories.create', compact('rows'));
    }

    public function store(StoreSubCategory $request)
    {
        Category::create($request->validated());
        alert()->success('Category added successfully', 'Success');
        return redirect()->route('admin.sub-categories.index');
    }

    public function edit(Category $sub_category)
    {
        $row = $sub_category;
        $rows = Category::where('parent_id' , '=' , null)->get();
        return view('admin.SubCategories.edit', compact('row' , 'rows'));
    }

    public function update(updateCategory $request, Category $sub_category)
    {
        $sub_category->update($request->validated());
        alert()->success('Category updated successfully', 'Success');
        return redirect()->route('admin.sub-categories.index');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.sub-categories.index')->with('success', 'Category deleted successfully');
    }
}
