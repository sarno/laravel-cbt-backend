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
        //ddd($request->all());

        $filename = null;
        if ($request->hasFile('image')) {
            $filename = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/categories', $filename);
        }

        $validate = $request->validate([
            'name' => 'required|max:100',
            'description' => 'required|max:100',
        ]);

        try {
            $cate = new Category();
            $cate->name = $request->name;
            $cate->description = $request->description;
            $cate->image = $filename;
            $cate->save();

            return redirect()->route('category.index')->with('Berhasil', 'Kategori berhasil di buat');

        } catch (\Throwable $th) {
            return redirect()->route('category.index')->with('error', $th);
        }
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
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        //  update category
        if ($request->hasFile('image')) {
            $filename = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/categories', $filename);
            $category->image = $filename;
        }


        $validate = $request->validate([
            'name' => 'required|max:100',
        ]);



        try {

            $category->update([
                'name' => $request->name,
                'description' => (int) $request->price,
            ]);

            return redirect()->route('category.index')->with('Berhasil', 'Kategori berhasil diperbarui');

        } catch (\Throwable $th) {
            return redirect()->route('category.index')->with('Gagal', $th);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // delete category
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('category.index')->with('Berhasil', 'Kategori berhasil di hapus');
    }
}
