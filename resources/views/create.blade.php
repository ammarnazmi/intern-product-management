@extends('layouts.master')

@section('title', 'Create Product')

@section('content')
<div class="col-12 col-lg-8">
  <div class="card">
    <div class="card-body">

      {{-- errors --}}
      @if ($errors->any())
        <div class="alert alert-danger">
          <div class="fw-semibold mb-1">Please fix the following:</div>
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('products.store') }}" method="POST" novalidate>
        @csrf

        <div class="mb-3">
          <label class="form-label">Name</label>
          <input type="text" name="name"
                 class="form-control @error('name') is-invalid @enderror"
                 value="{{ old('name') }}" required maxlength="255">
        </div>

        <div class="mb-3">
          <label class="form-label">Description</label>
          <textarea name="description" rows="4"
                    class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
          <label class="form-label">Price (RM)</label>
          <input type="number" step="0.01" min="0" name="price"
                 class="form-control @error('price') is-invalid @enderror"
                 value="{{ old('price', '0.00') }}" required>
        </div>

        <div class="d-flex gap-2">
          <button type="submit" class="btn btn-primary">Save</button>
          <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
      </form>

    </div>
  </div>
</div>
@endsection
