@extends('structure.template')
@section('content')
<main style="margin-left: 15%; margin-top: 5%">
    <div class="container-fluid px-4">
        <h1 class="mt-4">Payment History</h1>



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
                            <th>Action</th>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>



</main>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

