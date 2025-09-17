@extends('layouts.master') {{-- or @extends('master') if that’s your layout --}}

@section('title', 'Edit Product')

@section('content')
<div class="col-12 col-lg-8">
  <div class="card">
    <div class="card-body">

      {{-- error messages --}}
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('products.update', $product) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
          <label class="form-label">Name</label>
          <input type="text" name="name"
                 class="form-control @error('name') is-invalid @enderror"
                 value="{{ old('name', $product->name) }}" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Description</label>
          <textarea name="description" rows="4"
                    class="form-control @error('description') is-invalid @enderror">{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="mb-3">
          <label class="form-label">Price (RM)</label>
          <input type="number" min="0" name="price"
                 class="form-control @error('price') is-invalid @enderror"
                 value="{{ old('price', $product->price) }}" required>
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
