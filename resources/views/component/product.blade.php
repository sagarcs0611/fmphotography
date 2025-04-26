@extends('structure.template')
@section('content')
<main style="margin-left: 15%; margin-top: 5%">
    <div class="container-fluid px-4">
        <h1 class="mt-4">Product</h1>

        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html" style="text-decoration: none;">Dashboard</a></li>
            <li class="breadcrumb-item active">Product</li>
        </ol>

        <!-- <div class="text-end">
            <a href="{{route('product.new')}}" class="btn btn-success mb-3">Add New</a>
        </div> -->
        <div class="card mb-4">

            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Short Description</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Product Name</th>
                            <th>Short Description</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($product_data as $product)
                        <tr>
                            <td>{{$product->product_name}}</td>
                            <td>{{$product->short_description}}</td>
                            <td>{{$product->price}}</td>
                            <td>
                                <div class="flex items-center gap-4">
                                    <a href="javascript:void(0);" class="text-blue-500 edit-btn" data-bs-toggle="modal" data-bs-target="#editModal" data-id="{{$product->product_id}}" data-productName="{{$product->product_name}}" data-price="{{$product->price}}" data-description="{{$product->short_description}}">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <a href="javascript:void(0);" class="text-red-500 delete-btn" data-id="{{$product->product_id}}">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="edit-form">
                    <div class="modal-body">
                        <input type="text" class="form-control mb-2" placeholder="Product ID" name="product_id" id="product_id">
                        <input type="text" class="form-control mb-2" placeholder="Product Name" name="product_name" id="product_name">
                        <input type="text" class="form-control mb-2" placeholder="Short Description" name="product_description" id="short_description">
                        <input type="text" class="form-control mb-2" placeholder="Price" name="price" id="price">

                        <div id="product_service">

                        </div>

                        <div id="service_name">

                        </div>
                        <button type="button" class="btn btn-primary" id="addMore">Add More</button>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="saveChanges">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</main>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>

    // Edit and update
    $(document).on('click', '.edit-btn', function() {
        const productId = $(this).data('id');
        $('#product_id').val(productId);
        document.getElementById("product_name").value = this.getAttribute("data-productName");
        document.getElementById("price").value = this.getAttribute("data-price");
        document.getElementById("short_description").value = this.getAttribute("data-description");
        $.ajax({
            url: "{{route('edit.product.data')}}",
            type: 'GET',
            data: {
                productId: productId
            },
            success: function(response) {
                $('#product_service').empty();

                response.forEach(function(item, index) {
                    const inputHTML = `
                            <div class="mb-2 input-group align-items-center">
                                <div class="flex-grow-1">
                                    <label>Service ${index + 1}</label>
                                    <input type="text" name="product_servives[]" class="form-control" value="${item.service_name}" data-id="${item.service_id}">
                                </div>
                                <button type="button" class="btn btn-danger btn-sm ms-2 remove-service mt-2">×</button>
                            </div>
                        `;
                    $('#product_service').append(inputHTML);
                });

                $('#product_service').on('click', '.remove-service', function() {
                    $(this).closest('.input-group').remove();
                });
                $('#editModal').modal('show');
            },
            error: function() {
                alert('Failed to fetch product data.');
            }
        });

        $('#saveChanges').click(function() {
            const id = $('#edit-id').val();
            const title = $('#edit-title').val();

            let serviceValues = [];

            $('input[name="product_servives[]"]').each(function() {
                serviceValues.push($(this).val());
            });

            // console.log(data);
            // alert('hi');
            $.ajax({
                url: " {{route('update.product.data')}}",
                type: 'POST',
                data: {
                    productId: $("#product_id").val(),
                    productName: $("#product_name").val(),
                    productDescription: $("#short_description").val(),
                    productPrice: $("#price").val(),
                    productServices: serviceValues,
                    _token: '{{ csrf_token() }}'
                },
                success: function() {
                    $('#editModal').modal('hide');
                    location.reload();
                },
                error: function() {
                    alert('Failed to save changes.');
                }
            });
        });
    });

    // Add new item
    var counter = 2;
    $(document).ready(function() {
        $("#addMore").click(function() {
            var newItem = `
            <div class="mb-2 input-new-group align-items-center">
                <div class="flex-grow-1">
                    <label for="service_name_${counter}" class="form-label">Service Name</label>
                    <input type="text" class="form-control" id="service_name_${counter}" name="product_servives[]">
                </div>
                <button type="button" class="btn btn-danger btn-sm ms-2 remove-new-service mt-2">×</button>
            </div>

        `;

            $("#service_name").append(newItem);
            counter++;
        });

        $('#service_name').on('click', '.remove-new-service', function() {
            $(this).closest('.input-new-group').remove();
        });

    });

    $(document).on('click', '.delete-btn', function() {
        const productId = $(this).data('id');
        $.ajax({
            url: "{{route('delete.product.data')}}",
            type: 'get',
            data: {
                productId: productId
            },
            success: function(response) {
                location.reload();
            },
            error: function() {
                alert('Failed to fetch product data.');
            }
        });
    });

</script>
