@extends('back-end.admin-layout')

@section('content')

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header p-4">
                    <a class="pt-2 d-inline-block main-text-color" href="#" data-abc="true"><h2>DRB</h2></a>
                    <div class="float-right">
                        <h4 class="mb-0">Invoice {{$invoice->unique_id}}</h4>
                        Date: {{$invoice->created_at->format('d/m/Y')}}
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <h5 class="mb-3">From:</h5>
                            <h4 class="text-dark mb-1">Data Resoources BD</h4>
                            <div>29, Uttara</div>
                            <div>Dhaka-1209</div>
                            <div>Email: contact@drb.com</div>
                            <div>Phone: +88 017 55 837774</div>
                        </div>
                        <div class="col-sm-6 ">
                            <h5 class="mb-3">To:</h5>
                            <h4 class="text-dark mb-1">Client Name</h4>
                            <div>{{$invoice->user->full_name}}</div>
                            <div>Email: {{$invoice->user->email}}</div>
                            <div>Phone: {{$invoice->user->contact_number}}</div>
                        </div>
                    </div>
                    <div class="table-responsive-sm">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Plan</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Type</th>
                                <th>User Limit</th>
                                <th>Status</th>
                                <th>Transaction Id</th>
                                <th>Expire Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{$invoice->subscriptionplan->name}}</td>
                                <td>{{$invoice->subscriptionplan->name}} Package for {{$invoice->user_limit}} user</td>
                                <td>{{$invoice->price}}</td>
                                <td>{{$invoice->type}}</td>
                                <td>{{$invoice->user_limit}}</td>
                                <td>Pending..</td>
                                <td>{{$invoice->transaction_id}}</td>
                                <td>{{\Carbon\Carbon::parse($invoice->expire_date)->format('d F Y')}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <h5 class="text-dark mt-4 mb-3">Check Image : </h5>
                    <div class="row">
                        <div class="col-md-10 col-sm-12">
                            <img src="{{asset('/storage/bank_checks/' . $invoice->check_image)}}" alt="" width="100%" height="300">
                        </div>

                        <div class="col-md-2 col-sm-12 text-center d-flex justify-content-center align-items-center">
                            <ul class="approve-btn-section">
                                <li><a href="{{route('offline.payments.approve', $invoice->id)}}" class="btn btn-outline-warning" style="padding-left: 18px;padding-right: 19px; margin-bottom:5px;">Approve</a></li>
                                <li><a href="{{asset('/storage/bank_checks/' . $invoice->check_image)}}" download="" class="btn btn-outline-warning">Download</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white">
                    <p class="mb-0">Thanks for purchase. DRB</p>
                </div>
            </div>
        </div>
    </div>

@endsection
