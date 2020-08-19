@extends('front-end.main-layout')
@section('content')
    <!-- Navigation -->

    <section class="financial-statement mb-5">
        <style type="text/css">
            .card-right-section {
                /*padding-top: 30px;*/
                float: right;
            }
            .form-check {
                text-align: right;
            }
            .form-check input {
                margin-top: 60px;
            }
            .single-news-border p {
                margin-bottom: 0;
                font-size: 14px;
            }
            .total {
                background-color: #101c53;
                color: #fff;
                padding: 12px 20px;
                border-radius: 3px;
            }
        </style>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Personal Info</h2>
                </div>
            </div>
            <form method="post" action="{{route('payment')}}">
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="bg-white my-4 mx-1 p-3 shadow-sm">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name:</label>
                                        <input class="form-control" name="name" type="text" value="{{$userInfo->full_name}}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email:</label>
                                        <input class="form-control" name="email" type="email" value="{{$userInfo->email}}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Mobile No:</label>
                                        <input class="form-control" name="mobile_no" type="text" value="{{$userInfo->contact_number}}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Address:</label>
                                        <input class="form-control" name="address" type="text" placeholder="Enter Address">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>City:</label>
                                        <input class="form-control" name="city" type="text" placeholder="Dhaka">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Post Code:</label>
                                        <input class="form-control" name="postCode" type="email" placeholder="1215">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="total">
                            <span>Payable Total</span>
                            <span id="grandTotal" data-grandtotal="0.00" class="float-right">{{$cart->total}} BDT</span>
                        </div>
                        <div class="checkout mt-4">
                            <input type="hidden" name="cart_id" value="{{$cart->id}}"/>
                            <button type="submit" class="btn btn-warning btn-sm my-2 my-sm-0 mx-1 mt-3 float-right">Checkout</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

@section('scripts')
    <script type="application/javascript">

    </script>
@endsection

@endsection
