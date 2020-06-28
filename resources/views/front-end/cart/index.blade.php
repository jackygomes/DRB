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
                    <h2>Cart</h2>
                </div>
            </div>
            <form method="post" action="{{route('checkout')}}">
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        @if($message = Session::get('success'))
                            <div class="alert alert-success">
                                {{$message}}
                            </div>
                        @endif
                        @foreach ($cart->cartItems as $item)
                        <div class="shadow-sm mb-3 single-news-border item_{{$item->id}}">
                            <div id="3584" class="row">
{{--                                <div class="col-md-1">--}}
{{--                                    <div class="form-check">--}}
{{--                                        <input id="cartItem_{{$item->id}}" onClick="totalCalculate({{$item->id}})" type="checkbox" class="form-check-input" name="cartItem_{{$item->id}}">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="col-md-3">
                                    <img src="https://data-resources-bd.s3-ap-southeast-1.amazonaws.com/production/news/images/Xk1JCys7lHoxOecHgloUuYMGFldVXrR0LBqTdbP3.jpeg" alt="..." class="img-fluid news-index-img">
                                </div>
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <a href="https://www.newagebd.net/article/107855/poverty-rate-rises-to-35pc" target="_blank">
                                                <h5>{{$item->product->name}}</h5>
                                            </a>
                                            <p class="text-secondary ">Unit Price: {{$item->product->price}} BDT</p>
                                            <p class="text-secondary ">Quantity: {{$item->quantity}} </p>
                                        </div>
                                        <div class="col-md-5">
                                            <div id="subtotal_{{$item->id}}" class="card-right-section" data-subtotal="{{$item->price}}">
                                                Subtotal : {{$item->price}} BDT
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8"></div>
                                        <div class="col-md-4">
                                            <a href="{{route('cart.item.delete', $item->id)}}" class="btn btn-outline-danger float-right">Remove</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
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
            // $(document).ready(function() {
            //     function totalCalculate(id) {
            //         let checkboxId = 'cartItem_'+id;
            //         let subTotalId = '#subtotal_'+id;
            //         let checkBox = document.getElementById(checkboxId);
            //         let subTotal = parseFloat($(subTotalId).data( "subtotal" ));
            //         let grandTotal = parseFloat($('#grandTotal').data( "grandtotal" ));
            //
            //         // If the checkbox is checked, display the output text
            //         if (checkBox.checked == true){
            //             grandTotal = grandTotal + subTotal;
            //             $('#grandTotal').data( "grandtotal", grandTotal ) ;
            //             $('#grandTotal').html(grandTotal+' BDT');
            //         } else {
            //             grandTotal = grandTotal - subTotal;
            //             $('#grandTotal').data( "grandtotal", grandTotal ) ;
            //             $('#grandTotal').html(grandTotal+' BDT');
            //         }
            //     }
            // } );
        </script>
    @endsection

@endsection
