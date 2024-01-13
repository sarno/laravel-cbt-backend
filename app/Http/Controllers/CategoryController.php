<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories  = DB::table('categories')
        ->when($request->search, function($query) use ($request)  {
            return  $query->where('name', 'like','%'.$request->search.'%');

        })
        ->paginate(5);

        return view('pages.category.index', compact('categories'));
    }

    public function create()
    {
        return view('pages.category.create');
    }


    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|max:100',
        ]);

        Category::create($validate);

        return redirect()->route('category.index')->with('success', 'Category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // edit category
        $category = Category::findOrFail($id);
        return view('pages.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //  update category
        $validate = $request->validate([
            'name' => 'required|max:100',
        ]);

        $category = Category::findOrFail($category->id);
        $category->update($validate);

        return redirect()->route('category.index')->with('success', 'Category updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // delete category
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('category.index')->with('success', 'Category deleted successfully');
    }
}
