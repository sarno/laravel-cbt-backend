<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $products  = DB::table('products')
        ->when($search, function ($query) use($search) {
            return $query->where('name', 'like', '%'. $search.'%' );
        })
        ->orderBy('created_at','desc')
        ->paginate(5);


        return view('pages.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('pages.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $filename = time() . '.' . $request->image->extension();
        $request->image->storeAs('public/products', $filename);
        $data = $request->all();

        try {
            $product = new Product;
            $product->name = $request->name;
            $product->price = (int) $request->price;
            $product->stock = (int) $request->stock;
            $product->category_id = $request->category_id;
            $product->image = $filename;
            $product->save();

            return redirect()->route('product.index')->with('success', 'Product successfully created');

        } catch (\Throwable $th) {
            return redirect()->route('product.index')->with('error', $th);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
