@extends('layouts.master')

@section('title', 'Subproducts')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <a href="{{ route('subproducts.create') }}" class="btn btn-primary">Add Subproduct</a>
</div>

<div class="table-responsive">
  <table class="table table-bordered align-middle">
    <thead class="table-light">
      <tr>
        <th>Product Name</th>
        <th>Name</th>
        <th>Description</th>
        <th class="text-end" style="width:140px;">Price (RM)</th>
        <th style="width:180px;">Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse($subproducts as $sp)
        <tr>
          <td>{{ $sp->product->name}}</td>
          <td>{{ $sp->name }}</td>
          <td class="text-wrap">{{ $sp->description }}</td>
          <td class="text-end">{{ number_format($sp->price, 2) }}</td>
          <td>
            <a href="{{ route('subproducts.edit', $sp) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
            <form action="{{ route('subproducts.destroy', $sp) }}" method="POST" class="d-inline">
              @csrf
              @method('DELETE')
              <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this subproduct?')">Delete</button>
            </form>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="4">
            <div class="alert alert-info mb-0">No subproducts yet. Click <strong>Add Subproduct</strong> to create one.</div>
          </td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>

@if(method_exists($subproducts, 'links'))
  <div class="mt-2">
    {{ $subproducts->links('pagination::bootstrap-5') }}
  </div>
@endif
@endsection
