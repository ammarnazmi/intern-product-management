@extends('layouts.master')

@section('title', 'Products')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <a href="{{ route('products.create') }}" class="btn btn-primary">Add Products</a>
</div>

<div class="table-responsive">
  <table class="table table-bordered align-middle">
    <thead class="table-light">
      <tr>
        <th>Name</th>
        <th>Description</th>
        <th style="width:180px;">Actions</th>
      </tr>
    </thead>
    <tbody x-data="{products: [
        { id: 1, name: 'Product', description: 'Description of product' }
        ]}">

        <template x-if="products.length === 0">
             <td colspan="4">
            <div class="alert alert-info mb-0">
              No products yet. Click Add Products to create.
            </div>
          </td>
        </tr>
        </template>

        <template x-for="p for products" :key="p.id">
        <tr>
          <td x-text=p.name </td>
          <td x-text="text-wrap">{{ $p->description }}</td>
          <td>
            <input x-model="{{ route('products.edit', $p) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
            <input x-model="{{ route('products.destroy', $p) }}" method="POST" class="d-inline">
              @csrf @method('DELETE')
              <button @click="open = ! open">Delete</button>
            </form>
          </td>
        </tr>
      @empty
        <tr>
        </template>
    </tbody>
      @forelse($products as $p)
      @endforelse
    </tbody>
  </table>
</div>

@if(method_exists($products, 'links'))
  <div class="mt-2">
    {{ $products->links('pagination::bootstrap-5') }}
  </div>
@endif
@endsection
