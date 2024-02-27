@extends('adminend.layout.default')

@section('title')
    Product list
@endsection

@section('content')
    <div class="row">
        <div class="col-md-2">

        </div>
        <div class="col-md-8">
            <h2 class="my-3 text-center">Ajax CRUD</h2>
            <a href="" class="btn btn-success my-3" data-bs-toggle="modal" data-bs-target="#addProductModal">
                <i class="fa-solid fa-plus"></i>
                Add
            </a>

            <div class="row d-flex mb-5">
                {{-- Product search useing jquery --}}
                <div class="col-md-6">
                    <input
                        type="search"
                        class="form-control"
                        placeholder="Product search"
                        aria-label="Username"
                        id="input-search"
                    >
                </div>
                <div class="col-md-6">
                    <input
                        type="search"
                        class="form-control w-full"
                        placeholder="jquery autocomplete"
                        aria-label="Username"
                        id="product_search"
                    >
                </div>
            </div>

            <div class="table-data mt-2">
                <table class="table border">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-body">
                        @foreach ($products as $key => $product)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>
                                    <a href="" id="btnEditProductModal" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#editProductModal" data-product-id="{{ $product->id }}"
                                        data-product-name="{{ $product->name }}" data-product-price="{{ $product->price }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a href="" id="btnProductDelete" data-product-id="{{ $product->id }}"
                                        class="btn btn-danger">
                                        <i class="fa-solid fa-trash-can-arrow-up"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $products->links() !!}
            </div>
        </div>
    </div>

    {{-- Load create modal --}}
    @include("adminend.pages.product.create-modal")

    {{-- Load edit modal --}}
    @include("adminend.pages.product.edit-modal")
@endsection

@push('scripts')
    {{-- Load product crud script --}}
    @include("adminend.pages.product.product-script")
@endpush
