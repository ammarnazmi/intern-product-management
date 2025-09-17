@extends('master')

@section('title', 'Products')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Products</h4>
    <a href="{{ route('products.create') }}" class="btn btn-primary">+ Add Product</a>
</div>

@if($products->count())
  <div class="table-responsive">
    <table class="table table-bordered align-middle">
      <thead class="table-light">
        <tr>
          <th style="width: 50px;">ID</th>
          <th>Name</th>
          <th>Description</th>
          <th style="width: 100px;" class="text-end">Price (RM)</th>
          <th style="width: 100px;">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($products as $p)
          <tr>
            <td>{{ $p->id }}</td>
            <td>{{ $p->name }}</td>
            <td class="text-wrap">{{ $p->description }}</td>
            <td class="text-end">{{ number_format($p->price, 2) }}</td>
            <td>
              <a href="{{ route('products.edit', $p) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
              <form action="{{ route('products.destroy', $p) }}" method="POST" class="d-inline">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-sm btn-outline-danger"
                        onclick="return confirm('Delete this product?')">Delete</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <div>
    {{ $products->links('pagination::bootstrap-5') }}
  </div>
@else
  <div class="alert alert-info">No products yet. Click “Add Product” to create one.</div>
@endif
@endsection
