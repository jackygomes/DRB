@extends('front-end.main-layout')
@section('content')
<!-- Navigation -->

<section class="financial-statement">
{{--    <div class="container h-100">--}}
{{--        @if($page)--}}
{{--            <h3>{{$page->title}} </h3>--}}
{{--            <p>{{$page->description}} </p>--}}
{{--            <div class="row align-items-center h-100">--}}
{{--                <div class="col-md-12 text-center">--}}
{{--                    @include('front-end.pages.datatable')--}}

{{--                </div>--}}
{{--            </div>--}}
{{--        @else--}}
{{--            <h3 class="text-center mb-5">No Data Available </h3>--}}
{{--        @endif--}}
{{--    </div>--}}
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
                <div class="shadow-sm mb-3 single-news-border">
                    <div id="3584" class="row">
                        <div class="col-md-3">
                            <a href="https://www.newagebd.net/article/107855/poverty-rate-rises-to-35pc" target="_blank">
                                <img src="https://data-resources-bd.s3-ap-southeast-1.amazonaws.com/production/news/images/Xk1JCys7lHoxOecHgloUuYMGFldVXrR0LBqTdbP3.jpeg" alt="..." class="mb-3 img-fluid news-index-img">
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="https://www.newagebd.net/article/107855/poverty-rate-rises-to-35pc" target="_blank">
                                <h5>Poverty rate rises to 35pc</h5>
                            </a>
                            <p class="text-secondary ">Ticker: GP | Sector: Telco</p>
                            <p class="text-justify word-break">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque, deleniti eius expedita facere natus nemo placeat quas quisquam, quos repudiandae voluptate voluptatem? A aliquam aperiam autem cumque maxime recusandae ullam.
                            </p>
{{--                            <div class="row">--}}
{{--                                <div class="ml-auto pr-2 news-share-button-mobile">--}}
{{--                                    <div data-url="http://dataresources-bd.com//single-news/3584" data-title="Poverty rate rises to 35pc" data-description="New Age" data-media="https://data-resources-bd.s3-ap-southeast-1.amazonaws.com/production/news/images/Xk1JCys7lHoxOecHgloUuYMGFldVXrR0LBqTdbP3.jpeg" class="addthis_toolbox addthis_inline_share_toolbox news-share-buttons">--}}

{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                        <div class="col-md-3">
                            <div class="card-right-section">
                                <button class="btn btn-warning btn-sm my-2 my-sm-0 mx-1 mt-3">Add To Cart</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="shadow-sm mb-3 single-news-border">
                    <div id="3584" class="row">
                        <div class="col-md-3">
                            <a href="https://www.newagebd.net/article/107855/poverty-rate-rises-to-35pc" target="_blank">
                                <img src="https://data-resources-bd.s3-ap-southeast-1.amazonaws.com/production/news/images/Xk1JCys7lHoxOecHgloUuYMGFldVXrR0LBqTdbP3.jpeg" alt="..." class="mb-3 img-fluid news-index-img">
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="https://www.newagebd.net/article/107855/poverty-rate-rises-to-35pc" target="_blank">
                                <h5>Poverty rate rises to 35pc</h5>
                            </a>
                            <p class="text-secondary ">Ticker: GP | Sector: Telco</p>
                            <p class="text-justify word-break">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque, deleniti eius expedita facere natus nemo placeat quas quisquam, quos repudiandae voluptate voluptatem? A aliquam aperiam autem cumque maxime recusandae ullam.
                            </p>
                        </div>
                        <div class="col-md-3">
                            <div class="card-right-section">
                                <button class="btn btn-warning btn-sm my-2 my-sm-0 mx-1 mt-3">Add To Cart</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</section>

@endsection
