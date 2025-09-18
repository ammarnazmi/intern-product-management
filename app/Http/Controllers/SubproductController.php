<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubproductRequest;
use App\Models\Product;
use App\Models\Subproduct;
use Illuminate\Http\Request;

class SubproductController
{
    /**
     * List subproduct for a product
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
            : view('subproduct.index', compact('product', 'subproducts'));
    }

    /**
     * Show create form
     */
    public function create()
{
    $productsOptions = Product::orderBy('name')->pluck('name', 'id');
    return view('subproduct.form', [
        'subproduct' => new Subproduct(),
        'productsOptions' => $productsOptions,
    ]);
}

    /**
     * Store a new subproduct.
     */
    public function store(SubproductRequest $request, Product $product)
    {
        $data = $request->validated() + ['product_id' => $product->id];

        $subproduct = Subproduct::create($data);

        return redirect()
            ->route('products.subproduct.index', $product)
            ->with('success', __('Subproduct :name created successfully.', ['name' => $subproduct->name]));
    }

    /**
     * show edit form
     */
    public function edit(Subproduct $subproduct)
{
    $productsOptions = Product::orderBy('name')->pluck('name', 'id');
    return view('subproduct.edit', compact('subproduct') + [
        'productsOptions' => $productsOptions,
    ]);
}

    /**
     * update a subproduct form
     */
    public function update(SubproductRequest $request, Product $product, Subproduct $subproduct)
    {
        $subproduct->update($request->validated());

        return redirect()
            ->route('products.subproduct.index', $product)
            ->with('success', __('Subproduct :name updated successfully.', ['name' => $subproduct->name]));
    }

    /**
     * Delete a subproduct
     */
    public function destroy(Product $product, Subproduct $subproduct)
    {
        $subproduct->delete();

        return redirect()
            ->route('products.subproduct.index', $product)
            ->with('success', __('Subproduct :name deleted successfully.', ['name' => $subproduct->name]));
    }
}
