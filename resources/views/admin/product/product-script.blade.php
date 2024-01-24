<script>
    $(document).ready(function() {
        // Product create
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
                        showNotification(res.message);
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

        // Update edit form
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

        // Product update
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
                        showNotification(res.message);
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
        });

        // Product delete
        $(document).on("click", "#btnProductDelete", function(e) {
            e.preventDefault();
            let id = $(this).data("product-id");

            if (confirm("Are you sure to delete product ?")) {
                $.ajax({
                    url: "/admin/products/" + id,
                    type: "delete",
                    dataType: "json",
                    success: function(res) {
                        if (res.success) {
                            $(".table").load(location.href + " .table");
                            showNotification(res.message);
                        }
                    },
                    error: function(err) {
                        console.log(err);
                    }
                })
            }
        });

        $("#input-search").keyup(function() {
            var searchKey = $(this).val();
            $.ajax({
                url: "{{ route('paginate.data') }}",
                method: "GET",
                data: {
                    search_key: searchKey
                },
                success: function (res) {
                    if (res.data.data.length > 0) {
                        var products = res.data.data;
                        $(".table-body").empty();
                        var html = '';

                        $.each(products, function(index, product) {
                            html += `
                                <tr>
                                    <th scope="row">${index + 1} </th>
                                    <td> ${product.name}</td>
                                    <td> ${product.price}</td>
                                    <td>
                                        <a href="" id="btnProductUpdate" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#editProductModal" data-product-id="${product.id}"
                                            data-product-name="${product.name}" data-product-price="${product.price}">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <a href="" id="btnProductDelete" data-product-id="${product.id}"
                                            class="btn btn-danger">
                                            <i class="fa-solid fa-trash-can-arrow-up"></i>
                                        </a>
                                    </td>
                                </tr>
                            `
                        });

                        $(".table-body").append(html);
                    } else {
                        $(".table-body").empty();
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            })
        })

        // Pagination
        // $(document).on("click", ".pagination a", function(e) {
        //     e.preventDefault();

        //     let page = $(this).attr("href").split("page=")[1];
        //     console.log(page);
        //     pagination(page)

        // });

        // function pagination(page) {
        //     $.ajax({
        //         url: `/admin/pagination/products?page=${page}`,
        //         type: "get",
        //         dataType: "json",
        //         success: function(res) {
        //             console.log(res);
        //             $(".table-data").html(res);
        //         },
        //         error: function(err) {
        //             console.log(err);
        //         }
        //     })
        // }

        function showNotification(message) {
            Command: toastr["success"](message, "Success")

            toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
            }
        }
    })
</script>
