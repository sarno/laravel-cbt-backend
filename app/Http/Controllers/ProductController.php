<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $type_menu = 'layoutmasteronline';

        $search = Str::lower($request->search);
        $products  = DB::table('products as a')
        ->join('categories as b', 'a.category_id', '=', 'b.id')
        ->when($request->search, function ($query) use($request) {
            return $query->whereRaw('LOWER(name) like ?', ['%' . strtolower($request->search) . '%']);
        })
        ->select('a.*', 'b.name as category_name')
        ->orderBy('created_at','desc')
        ->paginate(5);

        return view('pages.product.index', compact('products','type_menu'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $type_menu = 'layoutmasteronline';

        $categories = Category::all();
        return view('pages.product.create', compact('categories','type_menu'));
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
            $product->description = $request->description;
            $product->price = (int) $request->price;
            $product->stock = (int) $request->stock;
            $product->category_id = $request->category_id;
            $product->image = $filename;
            $product->save();

            return redirect()->route('product.index')->with('Berhasil', 'Produk berhasil ditambahkan');

        } catch (\Throwable $th) {
            return redirect()->route('product.index')->with('Gagal', $th);
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
    public function edit($id)
    {
        $type_menu = 'layoutmasteronline';

        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('pages.product.edit', compact('product', 'categories','type_menu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // check image
        if ($request->hasFile('image')) {
            $filename = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/products', $filename);
            $product->image = $filename;
        }

        $product->update([
            'name' => $request->name,
            'price' => (int) $request->price,
            'stock' => (int) $request->stock,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('product.index')->with('Berhasil', 'Produk berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('product.index')->with('Berhasil', 'Produk berhasil dihapus');
    }
}
