@extends('layouts.master')

@section('title', 'Subproducts')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <a href="{{ route('subproducts.create') }}" class="btn btn-primary">Add Subproduct</a>
</div>

<div class="table-responsive" x-data="subproductList()">
  <table class="table table-bordered align-middle">
    <thead class="table-light">
      <tr>
        <th>Product Name</th>
        <th>Subproduct Name</th>
        <th>Description</th>
        <th class="text-end" style="width:140px;">Price (RM)</th>
        <th style="width:180px;">Actions</th>
      </tr>
    </thead>
    <tbody>
        <template x-if="subproducts.length=== 0">
        <tr>
          <td colspan="5">
            <div class="alert alert-info mb-0">No subproducts yet. Click <strong>Add Subproduct</strong> to create one.</div>
          </td>
        </tr>
        </template>

        <template x- for="subproduct for subproducts" :key="supbproduct.id">
        <tr>
          <td x-text="subproduct.product_name"></td>
          <td x-text="subproduct.name"></td>
          <td class="text-wrap" x-text="subproduct.description"></td>
          <td class="text-end"> x-text="formatPrice(subproduct.price)"></td>
          <td>
            <a :href="`/subproducts/${sp.id}/edit`" class="btn btn-sm btn-outline-secondary">Edit</a>
            <form :action="`/subproducts/${sp.id}`" method="POST" class="d-inline">
              @csrf
              @method('DELETE')
              <button class="btn btn-sm btn-outline-danger"
                      onclick="return confirm('Delete this subproduct?')">
                Delete
              </button>
            </form>
          </td>
        </tr>
      </template>
    </tbody>
  </table>
</div>

@push('js')
    <script>
        function subproductList() {
            return {
                subproducts: @json($subproducts),
            }
        }
    </script>
@endpush
