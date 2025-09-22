@extends('layouts.master')

@section('title', 'Products')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <a href="{{ route('products.create') }}" class="btn btn-primary">Add Products</a>
</div>

<div class="table-responsive" x-data="productList()">
  <table class="table table-bordered align-middle">
    <thead class="table-light">
      <tr>
        <th>Name</th>
        <th>Description</th>
        <th style="width:180px;">Actions</th>
      </tr>
    </thead>
    <tbody>

        <template x-if="products.length === 0">
            <tr>
            <td colspan="3">
            <div class="alert alert-info mb-0">
              No products yet. Click Add Products to create.
            </div>
          </td>
        </tr>
        </template>

        <template x-for="p in products" :key="p.id">
        <tr>
            <td x-text="p.name"></td>
            <td class="text-wrap" x-text="p.description"></td>
            <td>
            <a :href="`/products/${p.id}/edit`" class="btn btn-sm btn-outline-secondary">Edit</a>
            <form :action="`/products/${p.id}`" method="POST" class="d-inline">
              @csrf
              @method('DELETE')
              <button class="btn btn-sm btn-outline-danger"
                      onclick="return confirm('Delete this product?')">
                Delete
              </button>
            </form>
          </td>
        </tr>
      </template>
    </tbody>
  </table>
</div>
@endsection

@push('js')
    <script>
        function productList() {
            return {
                products: @json($products),
            }
        }
    </script>
@endpush
