@extends('structure.template')
@section('content')

<main style="margin-left: 15%; margin-top: 5%">
    <div class="container-fluid px-4">
        <h1 class="mt-4">Manage Proposal</h1>

        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html" style="text-decoration: none;">Dashboard</a></li>
            <li class="breadcrumb-item active">Manage Proposal</li>
        </ol>

        <div class="card mb-4">
            <div class="card-body">
                <form action="{{route('proposal.create')}}" method="POST">
                    @csrf
                    <input type="hidden" name="unique_id" value="{{$unique_id}}">
                    <div class="mb-3">
                        <label for="product_name" class="form-label">Package</label>
                        <select name="package" id="package" class="form-control">
                            <option value="">Select Package</option>
                            @foreach($get_product_name as $package)
                            <option value="{{$package->product_id}}">{{$package->product_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- <div class="mb-3">
                        <label for="description" class="form-label">Side</label>
                        <select name="side" id="side" class="form-control">
                            <option value="">Select Side</option>
                            <option value="single side">Single Side</option>
                            <option value="both side">Both Side</option>

                        </select>
                    </div> -->

                    <div class="mb-3" id="side_div" style="display: none;">
                        <label for="side" class="form-label">Side</label>
                        <input type="text" class="form-control" id="side" name="side" disabled>
                    </div>

                    <div id="side-container" class="row" style="display: none;">
                        <div class="col-md-6" id="side_a">
                            <div class="mb-3">
                                <label for="name_a" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name_a" name="name_a">
                            </div>

                            <div class="mb-3">
                                <label for="ph_a" class="form-label">Phone</label>
                                <input type="number" class="form-control" id="ph_a" name="ph_a">
                            </div>

                            <div class="mb-3">
                                <label for="email_a" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email_a" name="email_a">
                            </div>

                            <div class="mb-3">
                                <label for="address_a" class="form-label">Address</label>
                                <textarea name="address_a" id="address_a" name="address_a" class="form-control"></textarea>
                            </div>

                            <div class="mb-3" id="add-date-a">
                                <div>
                                    <label for="date_a_1" class="form-label">Date</label>
                                    <input type="date" class="form-control" id="date_a_1" name="date_a[]">
                                </div>
                            </div>
                            <button type="button" class="btn btn-sm btn-success" id="add-more-a" style="margin-bottom: 20px;">
                                <i class="fas fa-plus"></i> Add More
                            </button>
                        </div>

                        <div class="col-md-6" id="side_b">
                            <div class="mb-3">
                                <label for="name_b" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name_b" name="name_b">
                            </div>

                            <div class="mb-3">
                                <label for="ph_b" class="form-label">Phone</label>
                                <input type="number" class="form-control" id="ph_b" name="ph_b">
                            </div>

                            <div class="mb-3">
                                <label for="email_b" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email_b" name="email_b">
                            </div>

                            <div class="mb-3">
                                <label for="address_b" class="form-label">Address</label>
                                <textarea name="address_b" id="address_b" name="address_b" class="form-control"></textarea>
                            </div>

                            <div class="mb-3" id="add-date-b">
                                <div>
                                    <label for="date_b_1" class="form-label">Date</label>
                                    <input type="date" class="form-control" id="date_b_1" name="date_b[]">
                                </div>
                            </div>
                            <button type="button" class="btn btn-sm btn-success " id="add-more-b">
                                <i class="fas fa-plus"></i> Add More
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mb-3">Save Proposal</button>
                </form>
            </div>
        </div>
    </div>
</main>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    // var counter = 2;
    // $(document).ready(function() {
    //     $("#addMore").click(function() {
    //         var newItem = `
    //         <div class="input-group mb-2" id="input-group-${counter}">
    //             <label for="service_name_${counter}" class="form-label" style="margin-top:15px;">Service Name</label>
    //             <input type="text" class="form-control" id="service_name_${counter}" name="service_name[]" style="margin-left:20px; margin-top:15px;" required>
    //             <button type="button" class="btn btn-danger btn-sm remove-btn" data-id="${counter}" style="margin-top:15px;">
    //                     &times;
    //             </button>
    //         </div>
    //     `;

    //         $("#service_name").append(newItem);
    //         counter++;
    //     });
    //     $(document).on('click', '.remove-btn', function() {
    //         var id = $(this).data('id');
    //         $("#input-group-" + id).remove();
    //     });

    // });
</script>


<script>
    // $(document).ready(function() {
    //     $('#side').change(function() {
    //         var value = $(this).val();

    //         if (value === 'single side') {
    //             $('#side-container').show();
    //             $('#side_a').show();
    //             $('#side_b').hide();
    //         } else if (value === 'both side') {
    //             $('#side-container').show();
    //             $('#side_a').show();
    //             $('#side_b').show();
    //         } else {
    //             $('#side-container').hide(); // hide everything if no selection
    //         }
    //     });
    // });

    $(document).ready(function() {
        $('#package').change(function() {
            var value = $(this).val();
            if (!value) {
                $("#side_div").hide();
            }
            $.ajax({
                url: "{{route('package.details')}}",
                method: 'GET',
                data: {
                    product_id: value
                },
                success: function(response) {
                    console.log(response);
                    $("#side").val(response);
                    $("#side_div").show();
                    if (response === 'Single Side') {
                        $('#side-container').show();
                        $('#side_a').show();
                        $('#side_b').hide();
                    } else if (response === 'Both Side') {
                        $('#side-container').show();
                        $('#side_a').show();
                        $('#side_b').show();
                    } else {
                        $('#side-container').hide();
                    }
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>

<!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> -->
<script>
    var counter_a = 2;
    var counter_b = 2;

    $(document).ready(function() {
        $("#add-more-a").click(function() {
            var newItem_a = `
            <div>
                <label for="date_a_${counter_a}" class="form-label">Date</label>
                <input type="date" class="form-control" id="date_a_${counter_a}" name="date_a[]">
            </div>
        `;

            $("#add-date-a").append(newItem_a);
            counter_a++;
        });

        $("#add-more-b").click(function() {
            var newItem_b = `
            <div>
                <label for="date_b_${counter_b}" class="form-label">Date</label>
                <input type="date" class="form-control" id="date_b_${counter_b}" name="date_b[]">
            </div>
        `;

            $("#add-date-b").append(newItem_b);
            counter_b++;
        });


        $(document).on('click', '.remove-btn', function() {
            var id = $(this).data('id');
            $("#input-group-" + id).remove();
        });

    });
</script>
