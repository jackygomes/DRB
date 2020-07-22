@extends('front-end.main-layout')
@section('content')
    <!-- Navigation -->

    <section class="financial-statement">
        <style type="text/css">
            #sidebar {
                position: relative;
                height: auto;
            }
            .custom-news-nav-header-top { margin-top: 0; }
            .card-right-section {
                float: right;
                position: relative;
                height: 100%;
                width: 100%;
                text-align: right;
            }
            .word-break {padding-bottom: 0;}
            .single-news-border p {
                margin-bottom: 0;
                font-size: 14px;
            }
            .content-wrap {
                position: relative;
                height: 100%;
            }
            .content {
                height: 20px;
                overflow: hidden;
            }
            .read-more-button {
                color: #9a9da8;
                cursor: pointer;
                font-size: 12px !important;
                font-weight: bold;
            }
            .price {
                font-size: 16px !important;
                bottom: 0;
            }
            .price span {
                color:#4758a8;
                font-weight: bold;
            }
            .purchase-count {
                position: absolute;
                bottom: 30px;
                right: 7px;
                width: 100%;
            }
            .text-secondary span {
                color: #4758a8;
            }
        </style>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="wrapper">
                        <form action="{{route('research.list')}}" method="get" style="width: 100%;">
                            <div class="bg-white my-0 mx-1 p-3 shadow-sm">
                                <h4>Search Research By:</h4>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Company Name:</label>
                                            <select class="custom-select mr-sm-2" name="company_id">
                                                <option value="">All</option>
                                                @foreach($companies as $company)
                                                    <option value="{{$company->id}}" {{Request::get('company_id') == $company->id ? 'Selected' : ''}}>{{ $company->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Provider Name:</label>
                                            <input class="form-control" name="provider" value="{{Request::get('provider')}}" type="text" placeholder="Enter Provider Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Analyst Name:</label>
                                            <input class="form-control" name="analyst_name" value="{{Request::get('analyst_name')}}" type="text" placeholder="Enter Analyst Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-warning btn-sm my-2 my-sm-0 mx-1">Search</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-7">
                    @if($message = Session::get('success'))
                        <div class="alert alert-success">
                            {{$message}}
                        </div>
                    @endif
                    @foreach($products as $product)
                    <div class="shadow-sm mb-3 single-news-border">
                        <div id="3584" class="row">
                            <div class="col-md-3">
                                <img src="https://data-resources-bd.s3-ap-southeast-1.amazonaws.com/production/news/images/Xk1JCys7lHoxOecHgloUuYMGFldVXrR0LBqTdbP3.jpeg" alt="..." class="img-fluid news-index-img">
                            </div>
                            <div class="col-md-6">
                                <div class="content-wrap">
                                    <a href="https://www.newagebd.net/article/107855/poverty-rate-rises-to-35pc" target="_blank">
                                        <h5>{{$product->name}}</h5>
                                    </a>
                                    <p class="text-secondary ">Ticker: {{$product->company->ticker}} | Sector: {{$product->sector->name}}</p>
                                    <p class="text-secondary ">Research Date: <span>{{date('F j, Y', strtotime($product->date))}}</span></p>
                                    <p class="text-secondary ">Provider: <span>{{$product->provider}}</span></p>
                                    <p class="text-secondary ">{{count(json_decode($product->analysts)) > 1 ? 'Analysts' : 'Analyst'}}:<span> {{implode(', ', json_decode($product->analysts))}}</span></p>
                                    @if($product->description)
                                        <div class="description">
                                            <p id="content_{{$product->id}}" class="text-justify word-break content">
                                                {{$product->description}}
                                            </p>
                                            <p id="readMore_{{$product->id}}" class="read-more-button">Read More</p>
                                        </div>
                                    @endif
                                    <p class="price">Price:
                                        @if($product->price > 0)
                                        <span>BDT {{round($product->price, 2)}}</span>
                                        @else
                                        <span>Free</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card-right-section">
                                    @if(isset($cart) && collect($cart->CartItems)->contains('product_id', $product->id))
                                        <a href="#" class="btn btn-secondary btn-sm my-2 my-sm-0 mx-1 disabled"><i class="p3 fa fa-shopping-cart" ></i> Added</a>
                                    @else
                                        <a href="{{ route('addtocart', $product->id) }}" class="btn btn-warning btn-sm my-2 my-sm-0 mx-1"><i class="p3 fa fa-shopping-cart" ></i> Add To Cart</a>
                                    @endif
                                    <p class="purchase-count">Downloaded: {{$product->sell_count}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @if(count($products) == 0)
                        <h4>No Research Found </h4>
                    @endif
                </div>
                <div class="col-md-2">

                </div>
            </div>
        </div>
    </section>

@section('scripts')
    <script type="application/javascript">
        $(document).ready(function() {
            $('.read-more-button').click(function(){
                if($(this).text() == "Read More") {
                    $(this).html('Read Less');
                    let id = this.id.split('_');
                    $('#content_'+id[1]).css('height','100%');
                } else {
                    $(this).html('Read More');
                    let id = this.id.split('_');
                    $('#content_'+id[1]).css('height','20px');
                }
            });
        });
    </script>
@endsection

@endsection
