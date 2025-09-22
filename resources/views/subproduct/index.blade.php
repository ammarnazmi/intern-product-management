@extends('layouts.master')

@section('title', 'Subproducts')

@section('content')
    <div class="col-md-12" x-data="subproductList()">
        <div class="row mb-3">
            <div class="col-md-6">
                <a class="btn btn-outline-dark" href="{{ route('subproducts.create') }}">
                    <span class="fa-solid fa-plus"></span>
                    {{ __('Add Subproducts') }}
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
                            <th>{{ __('Price') }}</th>
                            <th width="10%">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template x-for="subproducts for subproducts" :key="subproduct.id">
                            <tr>
                                <td x-text="subproduct.name"></td>
                                <td class="text-wrap" x-text="subproduct.description"></td>
                                <td class="text-end"> x-text="formatPrice(subproduct.price)"></td>
                                <td>
                                    <a :href="`/subproducts/${subproduct.id}/edit`" class="btn btn-sm btn-outline-secondary">Edit</a>
                                    <form :action="`/subproducts/${subproduct.id}`" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Delete this subproduct?')">Delete
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
        function subproductList() {
            return {
                subproducts: @json($subproducts),
            }
        }
    </script>
@endpush
