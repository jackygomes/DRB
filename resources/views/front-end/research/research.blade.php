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
                padding-top: 30px;
                float: right;
            }
            .word-break {padding-bottom: 0;}
            .single-news-border p {
                margin-bottom: 0;
                font-size: 14px;
            }
        </style>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2">
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
                <div class="col-md-8">
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
                                <a href="https://www.newagebd.net/article/107855/poverty-rate-rises-to-35pc" target="_blank">
                                    <h5>{{$product->name}}</h5>
                                </a>
                                <p class="text-secondary ">Ticker: {{$product->company->ticker}} | Sector: {{$product->sector->name}}</p>
                                <p class="text-justify word-break">
                                    {{ \Illuminate\Support\Str::limit($product->description, 60, '...') }}
                                </p>
                            </div>
                            <div class="col-md-3">
                                <div class="card-right-section">
                                    <a href="{{ route('addtocart', $product->id) }}" class="btn btn-warning btn-sm my-2 my-sm-0 mx-1 mt-3">Add To Cart</a>
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

@endsection
