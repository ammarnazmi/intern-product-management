<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubproductRequest;
use App\Models\Product;
use App\Models\Subproduct;
use Illuminate\Http\Request;

class SubproductController
{
    /**
     * List subproducts for a product
     */
    public function index(Request $request, Product $product)
    {
        $columns = ['id', 'product_id', 'name', 'description', 'price', 'created_at'];
        $subproducts = Subproduct::query()
            ->where('product_id', $product->id)
            ->select($columns)
            ->latest('id')
            ->paginate(10);

        return $request->wantsJson()
            ? $subproducts
            : view('subproducts_index', compact('product', 'subproducts'));
    }

    /**
     * Show create form
     */
    public function create(Product $product)
    {
        return $this->edit($product, new Subproduct(['product_id' => $product->id]));
    }

    /**
     * Store a new subproduct.
     */
    public function store(SubproductRequest $request, Product $product)
    {
        $data = $request->validated() + ['product_id' => $product->id];

        $subproduct = Subproduct::create($data);

        return redirect()
            ->route('products.subproducts.index', $product)
            ->with('success', __('Subproduct :name created successfully.', ['name' => $subproduct->name]));
    }

    /**
     * show edit form
     */
    public function edit(Product $product, Subproduct $subproduct)
    {
        return view('subproducts_form', compact('product', 'subproduct'));
    }

    /**
     * update a subproduct form
     */
    public function update(SubproductRequest $request, Product $product, Subproduct $subproduct)
    {
        $subproduct->update($request->validated());

        return redirect()
            ->route('products.subproducts.index', $product)
            ->with('success', __('Subproduct :name updated successfully.', ['name' => $subproduct->name]));
    }

    /**
     * Delete a subproduct
     */
    public function destroy(Product $product, Subproduct $subproduct)
    {
        $subproduct->delete();

        return redirect()
            ->route('products.subproducts.index', $product)
            ->with('success', __('Subproduct :name deleted successfully.', ['name' => $subproduct->name]));
    }
}
