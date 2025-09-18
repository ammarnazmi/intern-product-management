@extends('layouts.master')


@section('title',
    match (true) {
        request()->is('*/create') => __('add Subproduct'),
        request()->is('*/edit')   => __('update Subproduct'),
        default                   => __('Subproduct'),
    }
)

@section('content')
<div class="col-12 col-lg-8">
  <div class="card">
    <div class="card-body">

    <form method="POST"
          action="{{ request()->is('*/create')
                        ? route('products.subproducts.store', $product)
                        : route('products.subproducts.update', [$product, $subproduct]) }}">

        @csrf
        @if (request()->is('*/edit')) @method('PUT') @endif

        <div class="mb-3">
          <label for="name" class="form-label">{{ __('Name') }}</label>
          <input type="text" id="name" name="name"
                 class="form-control @error('name') is-invalid @enderror"
                 value="{{ old('name', $subproduct->name ?? '') }}" required maxlength="255">
          @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>


        <div class="mb-3">
          <label for="description" class="form-label">{{ __('Description') }}</label>
          <textarea id="description" name="description" rows="4"
                    class="form-control @error('description') is-invalid @enderror">{{ old('description', $subproduct->description ?? '') }}</textarea>
          @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
          <label for="price" class="form-label">{{ __('Price (RM)') }}</label>
          <input type="number" id="price" name="price" step="0.01" min="0"
                 class="form-control @error('price') is-invalid @enderror"
                 value="{{ old('price', isset($subproduct->price) ? $subproduct->price : '0.00') }}" required>
          @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-primary">
          {{ request()->is('*/create') ? __('Create') : __('Update') }}
        </button>
        <a href="{{ route('products.subprodu', $product) }}" class="btn btn-outline-secondary">{{ __('Cancel') }}</a>
      </form>

    </div>
  </div>
</div>
@endsection
