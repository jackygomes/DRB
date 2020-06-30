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
                color: #1432bb;
                cursor: pointer;
                margin-bottom: 25px;
                font-size: 13px !important;
            }
            .price {
                font-size: 16px !important;
                bottom: 0;
            }
        </style>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="wrapper">
                        <!-- Sidebar  -->
                        <nav id="sidebar" class="bg-transparent text-dark custom-news-nav-header-top">

                            <ul class="list-unstyled components" style="padding-top: 0">
                                <li class="{{ request()->url() == route('news.index') ? 'news-sidenav-active' : '' }}">
                                    <a class="news-sidenav-hover" href="">All Research</a>
                                </li>
                                <li class="{{ request()->url() == route('news.index') ? 'news-sidenav-active' : '' }}">
                                    <a class="news-sidenav-hover" href="">Latest Research</a>
                                </li>
                                <li class="{{ request()->url() == route('news.index') ? 'news-sidenav-active' : '' }}">
                                    <a class="news-sidenav-hover" href="">City Brokerage</a>
                                </li>
                                <li class="{{ request()->url() == route('news.index') ? 'news-sidenav-active' : '' }}">
                                    <a class="news-sidenav-hover" href="">Shanta Securities</a>
                                </li>
                            </ul>
                        </nav>
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
                                    <div class="description">
                                        <p id="content_{{$product->id}}" class="text-justify word-break content">
                                            {{$product->description}}
                                        </p>
                                        <p id="readMore_{{$product->id}}" class="read-more-button">Read More</p>
                                    </div>
                                    <p class="price">Price: <span>BDT {{$product->price}}</span></p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card-right-section">
                                    @if(isset($cart) && collect($cart->CartItems)->contains('product_id', $product->id))
                                        <a href="#" class="btn btn-secondary btn-sm my-2 my-sm-0 mx-1 disabled"><i class="p3 fa fa-shopping-cart" ></i> Added</a>
                                    @else
                                        <a href="{{ route('addtocart', $product->id) }}" class="btn btn-warning btn-sm my-2 my-sm-0 mx-1"><i class="p3 fa fa-shopping-cart" ></i> Add To Cart</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </section>

@section('scripts')
    <script type="application/javascript">
        $(document).ready(function() {
            $('.read-more-button').click(function(){
                if($(this).text() == "Read More") {
                    $(this).text('Read Less');
                    let id = this.id.split('_');
                    $('#content_'+id[1]).css('height','100%');
                } else {
                    $(this).text('Read More');
                    let id = this.id.split('_');
                    $('#content_'+id[1]).css('height','20px');
                }
            });
        });
    </script>
@endsection

@endsection
