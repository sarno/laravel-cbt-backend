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
        $type_menu = 'layoutmasteronline';
        $categories  = DB::table('categories')
        ->when($request->search, function($query) use ($request)  {
            return  $query->whereRaw('LOWER(name) like ?', ['%' . strtolower($request->search) . '%']);

        })
        ->paginate(5);

        return view('pages.category.index', compact('categories', 'type_menu'));
    }

    public function create()
    {
        $type_menu = 'layoutmasteronline';
        return view('pages.category.create', compact('type_menu'));
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
        $type_menu = 'layoutmasteronline';

        // edit category
        $category = Category::findOrFail($id);
        return view('pages.category.edit', compact('category', 'type_menu'));
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
