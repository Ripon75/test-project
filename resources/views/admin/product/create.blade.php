<!-- Create Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addModalLable" aria-hidden="true">
    {{-- Modal form --}}
    <form action="" method="POST" id="addProductForm">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLable">Add Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="price" class="form-control" id="inputName" placeholder="Name">
                        <span id="nameErrorMessage"></span>
                    </div>

                    <div class="form-group mt-2">
                        <label for="price">Price</label>
                        <input type="text" name="price" class="form-control" id="inputPrice" placeholder="Price">
                        <span id="priceErrorMessage"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary" id="btnAddProduct">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </form>
    {{-- End form --}}
</div>
