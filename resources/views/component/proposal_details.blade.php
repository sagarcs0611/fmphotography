@extends('structure.template')
@section('content')
<main style="margin-left: 15%; margin-top: 5%">
    <div class="container-fluid px-4">
        <h1 class="mt-4">Proposal</h1>

        @if(Auth::user()->role == 'admin')
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html" style="text-decoration: none;">Dashboard</a></li>
            <li class="breadcrumb-item active">Proposal</li>
        </ol>
        @endif


        @if(count($proposal_details)>1)
            <div class="card mb-4">

                <div class="card-body">
                    <h3>{{$proposal_details[0]->product_name}}</h3>
                    <span>{{$proposal_details[0]->short_description}}</span>
                </div>

                <div class="card-body">
                    <h5>Your All Services:</h5>
                    <ul>
                        @foreach($proposal_details as $service)
                        <li>{{$service->service_name}}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="row card-body">
                    <div class="col-lg-6">
                        <h5>Client 1 Details</h5>
                        <div class="row">
                            <span>Client Name: {{$proposal_details[0]->client1_name}}</span>
                        </div>
                        <div class="row">
                            <span>Client Email: {{$proposal_details[0]->client1_email}}</span>
                        </div>
                        <div class="row">
                            <span>Client Phone No: {{$proposal_details[0]->client1_phone}}</span>
                        </div>
                        <div class="row">
                            <span>Client Address: {{$proposal_details[0]->client1_address}}</span>
                        </div>

                        @php
                        $client1_date = explode(",", $proposal_details[0]->client1_date)
                        @endphp

                        <div class="row card-body">
                            <span>Client Date:</span>
                            <ul>
                                @foreach($client1_date as $date)
                                <li>{{$date}}</li>
                                @endforeach
                            </ul>
                        </div>

                    </div>
                    @if($proposal_details[0]->side == 'Both Side')
                    <div class="col-lg-6">
                        <h5>Client 2 Details</h5>
                        <div class="row">
                            <span>Client Name: {{$proposal_details[0]->client2_name}}</span>
                        </div>
                        <div class="row">
                            <span>Client Email: {{$proposal_details[0]->client2_phone}}</span>
                        </div>
                        <div class="row">
                            <span>Client Phone No: {{$proposal_details[0]->client2_email}}</span>
                        </div>
                        <div class="row">
                            <span>Client Address: {{$proposal_details[0]->client2_address}}</span>
                        </div>

                        @php
                        $client2_date = explode(",", $proposal_details[0]->client2_date)
                        @endphp

                        <div class="row card-body">
                            <span>Client Date:</span>
                            <ul>
                                @foreach($client2_date as $date)
                                <li>{{$date}}</li>
                                @endforeach
                            </ul>
                        </div>

                    </div>
                    @endif
                </div>
            </div>
        @else
            <div class="card mb-4">
                <h5>No Data Found</h5>
            </div>
        @endif
    </div>
</main>
