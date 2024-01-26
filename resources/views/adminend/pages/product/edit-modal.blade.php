<!-- Create Modal -->
<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editModalLable" aria-hidden="true">
    {{-- Modal form --}}
    <form action="" method="POST" id="editProductForm">
        @csrf

        {{-- Hidden input --}}
        <input type="hidden" id="updateProductId">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLable">Edit Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="price" class="form-control" id="inputUpdateName">
                        <span class="text-danger" id="nameUpdateErrorMessage"></span>
                    </div>

                    <div class="form-group mt-2">
                        <label for="price">Price</label>
                        <input type="number" name="price" class="form-control" id="inputUpdatePrice">
                        <span class="text-danger" id="priceUpdateErrorMessage"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary" id="btnUpdateProduct">
                        Update
                    </button>
                </div>
            </div>
        </div>
    </form>
    {{-- End form --}}
</div>
