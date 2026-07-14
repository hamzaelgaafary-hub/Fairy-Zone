<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Product;
use App\Http\Requests\ProductFilterRequest;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(ProductFilterRequest $request)
    {
        //dd($request->validated());
        return view('products.index', [
            'products'   => Product::active()
                                   ->filter($request->validated())
                                   ->with(['primaryImage', 'category'])
                                   ->paginate(12)
                                   ->withQueryString(),
            'categories' => Category::active()->get(),
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product) 
    {
        //$product = Product::findOrFail($id);
        abort_if(!$product->is_active, 404);

        //dd($product);
        return view('products.show', [
            'product' => $product->load(['images', 'category']),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
