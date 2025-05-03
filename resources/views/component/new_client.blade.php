@extends('structure.template')
@section('content')

<main style="margin-left: 15%; margin-top: 5%">
    <div class="container-fluid px-4">
        <h1 class="mt-4">New Client</h1>

        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html" style="text-decoration: none;">Dashboard</a></li>
            <li class="breadcrumb-item active">New Client</li>
        </ol>

        <div class="card mb-4">
            <div class="card-body">
                <form action="{{route('client.add')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="client_name" class="form-label">Client Name</label>
                        <input type="text" class="form-control" id="client_name" name="client_name" required>
                    </div>

                    <div class="mb-3">
                        <label for="client_email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="client_email" name="client_email" required>
                    </div>

                    <div class="mb-3">
                        <label for="client_ph" class="form-label">Phone</label>
                        <input type="number" class="form-control" id="client_ph" name="client_ph" required>
                    </div>

                    <div class="mb-3">
                        <label for="client_address" class="form-label">Address</label>
                        <textarea name="client_address" class="form-control" id="client_address"></textarea>

                    </div>
                    <button type="submit" class="btn btn-primary">Save Client</button>
                </form>
            </div>
        </div>
    </div>
</main>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>

    var counter = 2;
    $(document).ready(function() {
        $("#addMore").click(function() {
            var newItem = `
            <div class="input-group mb-2" id="input-group-${counter}">
                <label for="service_name_${counter}" class="form-label" style="margin-top:15px;">Service Name</label>
                <input type="text" class="form-control" id="service_name_${counter}" name="service_name[]" style="margin-left:20px; margin-top:15px;" required>
                <button type="button" class="btn btn-danger btn-sm remove-btn" data-id="${counter}" style="margin-top:15px;">
                        &times;
                </button>
            </div>
        `;

            $("#service_name").append(newItem);
            counter++;
        });
        $(document).on('click', '.remove-btn', function() {
        var id = $(this).data('id');
        $("#input-group-" + id).remove();
    });

    });
</script>

