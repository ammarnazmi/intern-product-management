@extends('master')

@section('title', 'Edit Product')

@section('content')
<div class="col-12 col-lg-8">
  <div class="card">
    <div class="card-body">
      <form action="{{ route('products.update', $product) }}" method="POST" novalidate>
        @csrf @method('PUT')
        @include('products.edit', ['button' => 'Update'])
      </form>
    </div>
  </div>
</div>
@endsection
