@extends('master')

@section('title', 'Create Product')

@section('content')
<div class="col-12 col-lg-8">
  <div class="card">
    <div class="card-body">
      <form action="{{ route('products.store') }}" method="POST" novalidate>
        @csrf
        @include('products.partials._form', ['button' => 'Save'])
      </form>
    </div>
  </div>
</div>
@endsection
