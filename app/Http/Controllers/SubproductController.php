<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubproductRequest;
use App\Models\Product;
use App\Models\Subproduct;
use Illuminate\Http\Request;

class SubproductController
{
    /**
     * List of subproduct
     */
    public function index(Request $request)
    {
        $query = Subproduct::query();

        $columns = ['id', 'product_id', 'name', 'description', 'price'];

        $subproducts = Subproduct::with(['product:id,name'])->select(['id','product_id','name','description','price'])->latest('id')->paginate(10);

        return $request->wantsJson()
            ? $subproducts
            : view('subproduct.index', compact('subproducts'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        return $this->edit(new Subproduct());
    }

    /**
     * Store a new subproduct
     */
    public function store(SubproductRequest $request)
    {
        $data = $request->validated();

        $subproduct = Subproduct::create($data);

        return redirect()
            ->route('subproducts.index')
            ->with('success', __('Subproduct :name created successfully.', ['name' => $subproduct->name]));
    }

    /**
     * show edit form
     */
    public function edit(Subproduct $subproduct)
    {
        $productsOptions = Product::orderBy('name')->pluck('name', 'id');
        return view('subproduct.form', compact('subproduct', 'productsOptions'));
    }

    /**
     * update a subproduct form
     */
    public function update(SubproductRequest $request,  Subproduct $subproduct)
    {
        $data = $request->validated();

        $subproduct->update($data);

        return redirect()
            ->route('subproducts.index')
            ->with('success', __('Subproduct :name updated successfully.', ['name' => $subproduct->name]));
    }

    /**
     * Delete a subproduct
     */
    public function destroy(Subproduct $subproduct)
    {

        $subproduct->delete();

        return redirect()
            ->route('subproducts.index')
            ->with('success', __('Subproduct :name deleted successfully.', ['name' => $subproduct->name]));
    }
}
