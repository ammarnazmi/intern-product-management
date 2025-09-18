<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController
{
    /**
     * List products
     */
    public function index(Request $request)
    {
        $columns = ['id', 'name', 'description', 'price', 'created_at'];
        $products = Product::query()->select($columns)->latest('id')->paginate(10);

        return $request->wantsJson()
            ? $products
            : view('product.index', compact('products'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        return $this->edit(new Product());
    }

    /**
     * Store product
     */
    public function store(ProductRequest $request)
    {
        $product = Product::create($request->validated());

        return redirect()
            ->route('products.index')
            ->with('success', __('Product :name created successfully.', ['name' => $product->name]));
    }

    /**
     * Show edit form
     */
    public function edit(Product $product)
    {
        return view('product.form', compact('product'));
    }

    /**
     * Update product
     */
    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->validated());

        return redirect()
            ->route('products.index')
            ->with('success', __('Product :name updated successfully.', ['name' => $product->name]));
    }

    /**
     * Delete product
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', __('Product :name deleted successfully.', ['name' => $product->name]));
    }
}
