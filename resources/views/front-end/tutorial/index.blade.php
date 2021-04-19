@extends('front-end.main-layout')

@section('content')
    <style type="text/css">
        #sidebar {
            position: fixed;
            height: auto;
            top: 120px;
            max-width: 220px;
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
            cursor: pointer !important;
            font-size: 12px !important;
            color: #000 !important;
            font-weight: 600 !important;
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


        .research-price-section {
            position: absolute;
            bottom: 0;
        }

        @media only screen and (max-width: 767px) {
            .left-section{
                text-align: left;
            }
            .research-block{
                margin-top: 15px;
            }

            .amount-section{
                margin-top: 15px;
            }

            .mobile-margin{
                margin-top: 52px;
            }

            #sidebar{
                position: fixed;
                height: auto;
                width: 250px;
                margin-top: 173px;
            }
        }

    </style>
<section>
    <div class="container-fluid" style="margin-top: 120px;">
        <div class="row">
            <div class="col-md-12 top-news-bar">
                <button type="button" id="sidebarCollapse"
                        class="btn btn-warning my-2 d-md-none news-toggle-button news-sidenav-scroll-hide">
                    <i id="news-sidenav" class="fas fa-chevron-right"></i>
                    <span>Data Resource BD</span>
                </button>
            </div>

            {{--side menu--}}
            @include('front-end.tutorial.tutorial-side-menu')

            {{--tutorials--}}

            <div class="col-md-8">
                @if($message = Session::get('success'))
                    <div class="alert alert-success">
                        {{$message}}
                    </div>
                @endif
                @foreach($tutorials as $tutorial)
                    <div class="shadow-sm mb-3 single-news-border">
                        <div id="3584" class="row">

                            <div class="col-md-2">
                                @if(isset($tutorial->tutorial_image))
                                    <img src="{{env('S3_URL') . env('APP_ENV') . '/training/' . $tutorial->tutorial_image}}" alt="..." class="img-fluid news-index-img">
                                @else
                                    <img src="{{asset('img/DRB-logo.jpeg')}}" alt="..." class="img-fluid news-index-img">
                                @endif
                            </div>


                            <div class="col-md-7">
                                <div class="content-wrap research-block">
                                    <a href="{{ route('tutorials.details', $tutorial->id) }}">
                                        <h5>{{$tutorial->name}}</h5>
                                    </a>
                                    <p class="text-secondary ">Time: <span style="color: #222222; font-weight: 500;">{{$dateOrganizer->makePrettyDate($tutorial->date)}}</span></p>
                                    <p class="text-secondary ">Trainer:
                                        @foreach(json_decode($tutorial->trainers) as $trainers)
                                            {{$trainers->name}},
                                        @endforeach
                                    </p>

                                    @if($tutorial->description)
                                        <div class="description">
                                            <p id="content_{{$tutorial->id}}" class="text-justify word-break content">
                                                {{$tutorial->description}}
                                            </p>
                                            <p id="readMore_{{$tutorial->id}}" class="read-more-button">Read More</p>
                                        </div>
                                    @endif
                                    <p>
                                        @if($tutorial->price > 0)
                                            <span style="color: #666666;">Price: BDT {{round($tutorial->price, 2)}}</span>
                                        @else
                                            <span style="color: #666666;">Price: Free</span>
                                        @endif
                                    </p>
                                </div>
                            </div>


                            <div class="col-md-3 text-right amount-section">
                                <div class="row">
                                    <div class="col-md-12 col-6 left-section">
                                        @if(auth()->user())
                                            @if(!App\User::hasRegisteredOnThisTutorial($tutorial->id))
                                                <a href="{{ route('tutorials.payment', $tutorial->id) }}" class="btn btn-warning btn-sm my-2 my-sm-0 mx-1"> Register</a>
                                                @else
                                                <a href="javascript:void(0)" class="btn btn-success btn-sm my-2 my-sm-0 mx-1"> Registered</a>
                                            @endif
                                        @else
                                            <a href="{{URL::to('/login')}}" class="btn btn-warning btn-sm my-2 my-sm-0 mx-1"> Login</a>
                                        @endif

                                            <a href="{{route('tutorials.add.to.calendar', $tutorial->id)}}" class="btn btn-warning btn-sm my-2 my-sm-0 mx-1">Add To Calendar</a>
                                    </div>

                                    <div class="col-md-12 col-6 research-price-section">
                                        <a href="{{ route('tutorials.details', $tutorial->id) }}" class="btn btn-warning btn-sm my-2 my-sm-0 mx-1" style="padding-left: 13px;padding-right: 12px;"> Details</a>
                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>
                @endforeach
                @if(count($tutorials) == 0)
                    <h4 class="text-center">No Training Found </h4>
                @endif
            </div>

            {{--search option--}}
            {{--<div class="col-md-3">--}}
                {{--<div class="wrapper">--}}
                    {{--<form id="searchForm" action="{{route('research.list')}}" method="get" style="width: 100%;">--}}
                        {{--<div class="bg-white my-0 mx-1 p-3 shadow-sm">--}}
                            {{--<h4>Search Research By:</h4>--}}
                            {{--<div class="row">--}}
                                {{--<div class="col-md-12">--}}
                                    {{--<div class="form-group">--}}
                                        {{--<label>Company Name:</label>--}}
                                        {{--<select class="custom-select mr-sm-2" name="company_id">--}}
                                            {{--<option value="">All</option>--}}
                                            {{--@foreach($companies as $company)--}}
                                                {{--<option value="{{$company->id}}" {{Request::get('company_id') == $company->id ? 'Selected' : ''}}>{{ $company->name }}</option>--}}
                                            {{--@endforeach--}}
                                        {{--</select>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                                                            {{--<div class="row">--}}
                                                                {{--<div class="col-md-12">--}}
                                                                    {{--<div class="form-group">--}}
                                                                        {{--<label>Provider Name:</label>--}}
                                                                        {{--<select class="custom-select mr-sm-2" name="provider">--}}
                                                                            {{--<option value="">All</option>--}}
                                                                            {{--@foreach($providerNames as $providerName)--}}
                                                                                {{--<option value="{{$providerName}}" {{Request::get('provider') == $providerName ? 'Selected' : ''}}>{{ $providerName }}</option>--}}
                                                                            {{--@endforeach--}}
                                                                        {{--</select>--}}
                                                                    {{--</div>--}}
                                                                {{--</div>--}}
                                                            {{--</div>--}}
                            {{--<input id="providerName" class="form-control" name="provider" value="{{Request::get('provider')}}" type="hidden" placeholder="Enter Analyst Name">--}}
                            {{--<div class="row">--}}
                                {{--<div class="col-md-12">--}}
                                    {{--<div class="form-group">--}}
                                        {{--<label>Category:</label>--}}
                                        {{--<select class="custom-select mr-sm-2" name="category_id">--}}
                                            {{--<option value="">All</option>--}}
                                            {{--@foreach($researchCategories as $researchCategory)--}}
                                                {{--<option value="{{$researchCategory->id}}" {{Request::get('category_id') == $researchCategory->id ? 'Selected' : ''}}>{{ $researchCategory->name }}</option>--}}
                                            {{--@endforeach--}}
                                        {{--</select>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="row">--}}
                                {{--<div class="col-md-12">--}}
                                    {{--<div class="form-group">--}}
                                        {{--<label>Analyst Name:</label>--}}
                                        {{--<input class="form-control" name="analyst_name" value="{{Request::get('analyst_name')}}" type="text" placeholder="Enter Analyst Name">--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="row">--}}
                                {{--<div class="col-md-12">--}}
                                    {{--<button type="submit" class="btn btn-warning btn-sm my-2 my-sm-0 mx-1">Search</button>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                {{--</div>--}}
            {{--</div>--}}
        </div>
    </div>
    </section>

@endsection

@section('scripts')
    <script type="application/javascript">
        $(document).ready(function() {
            $('.provider').click(function(){
                $('#providerName').val($(this).data('name'));
                $('#searchForm').submit();
            });

            $('.read-more-button').click(function(){
                console.log('logi')
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