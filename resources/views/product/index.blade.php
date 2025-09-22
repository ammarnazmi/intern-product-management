@extends('layouts.master')

@section('title', __('List of Products'))

@section('content')
    <div class="col-md-12" x-data="productList()">
        <div class="row mb-3">
            <div class="col-md-6">
                <a class="btn btn-outline-dark" href="{{ route('products.create') }}">
                    <span class="fa-solid fa-plus"></span>
                    {{ __('Add Products') }}
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Description') }}</th>
                            <th width="10%">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template x-for="product for products" :key="product.id">
                            <tr>
                                <td x-text="product.name"></td>
                                <td class="text-wrap" x-text="product.description"></td>
                                <td>
                                    <a :href="`/products/${product.id}/edit`" class="btn btn-sm btn-outline-secondary">Edit</a>
                                    <form :action="`/products/${product.id}`" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Delete this product?')">Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        function productList() {
            return {
                products: @json($products),
            }
        }
    </script>
@endpush
