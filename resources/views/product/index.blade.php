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
    <tbody>
      @forelse($products as $p)
        <tr>
          <td>{{ $p->name }}</td>
          <td class="text-wrap">{{ $p->description }}</td>
          <td>
            <a href="{{ route('products.edit', $p) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
            <form action="{{ route('products.destroy', $p) }}" method="POST" class="d-inline">
              @csrf @method('DELETE')
              <button type="submit" class="btn btn-sm btn-outline-danger"
                      onclick="return confirm('Delete this product?')">Delete</button>
            </form>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="4">
            <div class="alert alert-info mb-0">
              No products yet. Click Add Products to create.
            </div>
          </td>
        </tr>
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
