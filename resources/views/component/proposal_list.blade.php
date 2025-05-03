@extends('structure.template')
@section('content')
<main style="margin-left: 15%; margin-top: 5%">
    <div class="container-fluid px-4">
        <h1 class="mt-4">Client List</h1>

        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html" style="text-decoration: none;">Dashboard</a></li>
            <li class="breadcrumb-item active">Client List</li>
        </ol>

        <!-- <div class="text-end">
            <a href="{{route('product.new')}}" class="btn btn-success mb-3">Add New</a>
        </div> -->
        <div class="card mb-4">

            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Client Name</th>
                            <th>Email</th>
                            <th>Phone No</th>
                            <th>Package Name</th>
                            <th>Price</th>
                            <!-- <th>Action</th> -->
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($proposal_list as $proposal)
                        <tr>
                            <td>{{$proposal->name}}</td>
                            <td>{{$proposal->email}}</td>
                            <td>{{$proposal->ph_no}}</td>
                            <td>{{$proposal->product_name}}</td>
                            <td>{{$proposal->price}}</td>
                            <!-- <td> -->

                                <!-- <a href="javascript:void(0);" class="text-blue-500 edit-btn" data-bs-toggle="modal" data-bs-target="#editModal" data-id="{{$proposal->client_id}}" data-productName="{{$proposal->product_name}}" data-description="{{$proposal->description}}" data-client1Name="{{$proposal->client1_name}}" data-client2Name="{{$proposal->client2_name}}" data-client1email="{{$proposal->client1_email}}" data-client2email="{{$proposal->client2_email}}" data-client1ph="{{$proposal->client1_phone}}" data-client2ph="{{$proposal->client2_phone}}" data-client1address="{{$proposal->client1_address}}" data-client2address="{{$proposal->client2_address}}" data-client1date="{{$proposal->client1_date}}" data-client2date="{{$proposal->client2_date}}">
                                    View
                                </a> -->
                            <!-- </td> -->
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
                    <h5 class="modal-title" id="editModalLabel">View Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="edit-form">
                    <div class="modal-body">

                        <div class="card mb-4">

                            <div class="card-body">
                                <h3 id="package_name"></h3>
                                <span id="short_desc">s</span>
                            </div>

                            <div class="card-body">
                                <h5>Your All Services:</h5>

                            </div>
                            <div class="row card-body">
                                <div class="col-lg-6">
                                    <h5>Client 1 Details</h5>
                                    <div class="row">
                                        <span>Client Name: d</span>
                                    </div>
                                    <div class="row">
                                        <span>Client Email: </span>
                                    </div>
                                    <div class="row">
                                        <span>Client Phone No: </span>
                                    </div>
                                    <div class="row">
                                        <span>Client Address: </span>
                                    </div>



                                    <div class="row card-body">
                                        <span>Client Date:</span>

                                    </div>

                                </div>

                            </div>
                        </div>




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
        console.log(this.getAttribute("data-productName"));

        $('#package_name').text(this.getAttribute("data-productName"));
        $('#short_desc').text(this.getAttribute("data-description"));

        document.getElementById("short_desc").value = this.getAttribute("data-description");
        document.getElementById("client_ph").value = this.getAttribute("data-ph");
        document.getElementById("client_address").value = this.getAttribute("data-address");
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
    });
</script>
