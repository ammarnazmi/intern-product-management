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
        <th style="width:60px;">ID</th>
        <th>Name</th>
        <th>Description</th>
        <th class="text-end" style="width:140px;">Price (RM)</th>
        <th style="width:180px;">Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse($products as $p)
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
      @empty
        <tr>
          <td colspan="5">
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
