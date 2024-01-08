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
                    <a href="" id="btnProductUpdate" class="btn btn-primary" data-bs-toggle="modal"
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
