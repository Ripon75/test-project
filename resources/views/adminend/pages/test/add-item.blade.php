@extends('adminend.layout.default')

@section('title')
    Test Design
@endsection

@section('content')
    <div class="row my-4">
        <div class="col-lg-10 mx-auto">
            <div class="card shadow">
                <div class="card-header">
                    <h1>Add Item</h1>
                </div>
                <div class="card-body p-4">
                    <form action="">
                        <div id="show-item">
                            <div class="row">
                                <div class="col-4 mb-2">
                                    <input type="text" name="name[]" class="form-control">
                                </div>
                                <div class="col-3 mb-2">
                                    <input type="number" name="price[]" class="form-control">
                                </div>
                                <div class="col-3 mb-2">
                                    <input type="number" name="quantity[]" class="form-control">
                                </div>
                                <div class="col-2 mb-2">
                                    <button class="btn btn-primary" id="btn-add-item">
                                        Add
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $("#btn-add-item").click(function(e) {
                e.preventDefault();

                var html =
                `<div class="row">
                    <div class="col-4 mb-2">
                        <input type="text" name="name[]" class="form-control">
                    </div>
                    <div class="col-3 mb-2">
                        <input type="number" name="price[]" class="form-control">
                    </div>
                    <div class="col-3 mb-2">
                        <input type="number" name="quantity[]" class="form-control">
                    </div>
                    <div class="col-2 mb-2">
                        <button class="btn btn-danger btn-removed-item">
                            Removed
                        </button>
                    </div>
                </div>`;

                $("#show-item").append(html);
            });

            $(document).on('click', '.btn-removed-item', function(e) {
                e.preventDefault();

                $(this).parent().parent().remove();
            });
        });
    </script>
@endpush
