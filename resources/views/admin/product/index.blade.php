<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    {{-- font awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Products</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-2">

            </div>
            <div class="col-md-8">
                <h2 class="my-3 text-center">Ajax CRUD</h2>
                <a
                    href=""
                    class="btn btn-success my-3"
                    data-bs-toggle="modal"
                    data-bs-target="#addProductModal">
                    <i class="fa-solid fa-plus"></i>
                    Add
                </a>
                <div class="table-data">
                    <table class="table border">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $key => $product)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>
                                        <a href=""
                                            id="btnProductUpdate"
                                            class="btn btn-primary"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editProductModal"
                                            data-product-id="{{ $product->id }}"
                                            data-product-name="{{ $product->name }}"
                                            data-product-price="{{ $product->price }}">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <a href=""
                                            id="btnProductDelete"
                                            data-product-id="{{ $product->id }}"
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
    </div>

    {{-- Load create modal --}}
    @include("admin.product.create-modal")

    {{-- Load edit modal --}}
    @include("admin.product.edit-modal")

    {{-- Load script --}}
    @include("admin.layout.script")

    {{-- Load product crud script --}}
    @include("admin.product.product-script")
</body>
</html>
