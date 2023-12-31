<script>
    $(document).ready(function() {
        $(document).on("click", "#btnAddProduct", function(e) {
            e.preventDefault();

            let name  = $("#inputName").val();
            let price = $("#inputPrice").val();

            $.ajax({
                url: "/admin/products",
                type: "post",
                dataType: "json",
                data: {
                    name,
                    price
                },
                success: function(res) {
                    if (res.success) {
                        $("#addProductModal").modal("hide");
                        $("#addProductForm")[0].reset();
                        $(".table").load(location.href + " .table");
                    }
                },
                error: function(err) {
                    let errors = err.responseJSON.errors;
                    if (errors.name) {
                        $("#nameErrorMessage").text(errors.name);
                    }
                    if (errors.price) {
                        $("#priceErrorMessage").text(errors.price);
                    }
                }
            })
        });

        $(document).on("click", "#btnProductUpdate", function() {
            // Get data dash value
            let id    = $(this).data("product-id");
            let name  = $(this).data("product-name");
            let price = $(this).data("product-price");

            // Update form input value
            $("#updateProductId").val(id)
            $("#inputUpdateName").val(name);
            $("#inputUpdatePrice").val(price);
        });

        $(document).on("click", "#btnUpdateProduct", function(e) {
            e.preventDefault();

            let id    = $("#updateProductId").val();
            let name  = $("#inputUpdateName").val();
            let price = $("#inputUpdatePrice").val();

            $.ajax({
                url: "/admin/products/" + id,
                type: "put",
                dataType: "json",
                data: {
                    name,
                    price
                },
                success: function(res) {
                    if (res.success) {
                        $("#editProductModal").modal("hide");
                        $(".table").load(location.href + " .table");
                    }
                },
                error: function(err) {
                    let errors = err.responseJSON.errors;
                    if (errors.name) {
                        $("#nameUpdateErrorMessage").text(errors.name);
                    }
                    if (errors.price) {
                        $("#priceUpdateErrorMessage").text(errors.price);
                    }
                }
            })
        })
    })
</script>
