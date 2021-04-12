@extends('front-end.main-layout')

@section('content')
<header id="home">
    <div class="hero-background">
        <div class="container-fluid h-100">
            <div class="row align-items-center h-100">
                <div class="col-md-12 text-center text-white mt-5">
                    <h5 class="mb-3 mt-5">1st Aggregate Data Platform of Bangladesh</h5>
                    <h1 class="my-4">1000+ curated contents</h1>
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <form action="{{route('search')}}" method="GET">
                                <div class="input-group search-bar-index">
                                    <input class="form-control py-4 " type="search" value="" name="search" placeholder="search for Company, Industry &amp News">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-warning px-5  " type="button">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row sliding-news">
            @if($top5s->isEmpty())
                <div class="col-4 col-sm text-center">
                    <h4 class="card-text main-text-color"><small>No news available</small></h4>
                </div>
            @else
                <div id="home-owl-carousel" class="owl-carousel mt-5 px-5">
                    @foreach ($top5s as $news)
                    <div>
                        <a href="{{$news->source}}" target="_blank">
                            <div class="card border-0 black-card">
                                @if($news->image)
                                    <img src="{{ env('S3_URL') }}{{ $news->image }}" class="card-img-top top5-news-img rounded-0" alt="...">
                                @endif
                                <p class="py-1 news-line-height"><small>{{ $news->heading }}</small></p>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    {{--<div class="container">--}}
        {{--<div class="row">--}}
            {{--<div class="col-md-12">--}}
                {{--<div class="card-deck mt-5">--}}
                    {{--<div class="card border-0">--}}
                        {{--<h4 class="main-text-color">World</h4>--}}
                        {{--@if($world)--}}
                        {{--<a href="{{$world->source}}" target="_blank">--}}
                            {{--@if($world->image)--}}
                            {{--<img src="{{ env('S3_URL') }}{{$world->image}}" class="card-img-top rounded-0 category-news-img" alt="...">--}}
                            {{--@endif--}}
                            {{--<h6 class="card-text main-text-color category-news-heading-border py-2 news-line-height">{{$world->heading}}</h6>--}}
                        {{--</a>--}}
                        {{--@else--}}
                            {{--<p class="card-text main-text-color"><small>No news available</small></p>--}}
                        {{--@endif--}}
                        {{--@foreach ($worlds as $world)--}}
                            {{--<a href="{{$world->source}}" target="_blank" class="category-news-heading-border category-news subnews-line-height"><small class="card-text main-text-color">{{implode(' ', array_slice(explode(' ', $world->heading ), 0, 20))}}</small></a>--}}
                        {{--@endforeach--}}
                    {{--</div>--}}

                    {{--<div class="card border-0">--}}
                        {{--<h4 class="main-text-color">Country</h4>--}}
                        {{--@if($country)--}}
                        {{--<a href="{{$country->source}}" target="_blank">--}}
                            {{--@if($country->image)--}}
                            {{--<img src="{{ env('S3_URL') }}{{$country->image}}" class="card-img-top rounded-0 category-news-img" alt="...">--}}
                            {{--@endif--}}
                            {{--<h6 class="card-text main-text-color category-news-heading-border py-2 news-line-height">{{$country->heading}}</h6>--}}
                        {{--</a>--}}
                        {{--@else--}}
                            {{--<p class="card-text main-text-color"><small>No news available</small></p>--}}
                        {{--@endif--}}
                        {{--@foreach ($countries as $country)--}}
                            {{--<a href="{{$country->source}}" target="_blank" class="category-news-heading-border category-news subnews-line-height"><small class="card-text main-text-color">{{implode(' ', array_slice(explode(' ', $country->heading ), 0, 20))}}</small></a>--}}
                        {{--@endforeach--}}
                    {{--</div>--}}

                    {{--<div class="card border-0">--}}
                        {{--<h4 class="main-text-color">Economy</h4>--}}
                        {{--@if($economy)--}}
                        {{--<a href="{{$economy->source}}" target="_blank">--}}

                            {{--@if($economy->image)--}}
                            {{--<img src="{{ env('S3_URL') }}{{$economy->image}}" class="card-img-top rounded-0 category-news-img" alt="...">--}}
                            {{--@endif--}}
                            {{--<h6 class="card-text main-text-color category-news-heading-border py-2 news-line-height">{{$economy->heading}}</h6>--}}
                        {{--</a>--}}
                        {{--@else--}}
                            {{--<p class="card-text main-text-color"><small>No news available</small></p>--}}
                        {{--@endif--}}
                        {{--@foreach ($economies as $economy)--}}
                            {{--<a href="{{$economy->source}}" target="_blank" class="category-news-heading-border category-news subnews-line-height"><small class="card-text main-text-color">{{implode(' ', array_slice(explode(' ', $economy->heading ), 0, 20))}}</small></a>--}}
                        {{--@endforeach--}}
                    {{--</div>--}}

                    {{--<div class="card border-0">--}}
                        {{--<h4 class="main-text-color">Company</h4>--}}
                        {{--@if($company)--}}
                        {{--<a href="{{$company->source}}" target="_blank">--}}
                            {{--@if($company->image)--}}
                             {{--<img src="{{ env('S3_URL') }}{{$company->image}}" class="card-img-top rounded-0 category-news-img" alt="...">--}}
                            {{--@endif--}}
                            {{--<h6 class="card-text main-text-color category-news-heading-border py-2 news-line-height">{{$company->heading}}</h6>--}}
                        {{--</a>--}}
                        {{--@else--}}
                            {{--<p class="card-text main-text-color"><small>No news available</small></p>--}}
                        {{--@endif--}}
                        {{--@foreach ($companies as $company)--}}
                            {{--<a href="{{$company->source}}" target="_blank" class="category-news-heading-border category-news subnews-line-height"><small class="card-text main-text-color">{{implode(' ', array_slice(explode(' ', $company->heading ), 0, 20))}}</small></a>--}}
                        {{--@endforeach--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="text-center">--}}
                    {{--<a href="/news" class="btn btn-warning my-5 rounded-pill px-5 mx-auto">Read More News</a>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{-- <div class="col-md-4">--}}
                {{--<div class="custom-header-top">--}}
                    {{--@if($sides->isEmpty())--}}
                        {{--<h4 class="card-text main-text-color text-center"><small>No news available</small></h4>--}}
                    {{--@else--}}
                        {{--@foreach ($sides as $side)--}}
                            {{--<h5 class="category-news-heading-border category-news pb-3 pt-2">--}}
                                {{--<a href="{{route('news.single',$side->id)}}">{{$side->heading}}</a>--}}
                            {{--</h5>--}}
                        {{--@endforeach--}}
                    {{--@endif--}}
                {{--</div>--}}
            {{--</div> --}}
        {{--</div>--}}
    {{--</div>--}}
</header>


{{--<section class="call-to-action bg-warning">--}}
    {{--<div class="container-fluid h-100">--}}
        {{--<div class="row text-center align-items-center h-100">--}}
            {{--@if (Auth::user())--}}
                {{--<div class="col-md-12">--}}
                    {{--<h1 class="main-text-color">Data Resources BD</h1>--}}
                {{--</div>--}}
            {{--@else--}}
                {{--<div class="col-md-2"></div>--}}
                {{--<div class="col-md-4">--}}
                    {{--<p class="main-text-color">Become a member &amp get <br> <strong>3 free downloads </strong></p>--}}
                {{--</div>--}}
                {{--<div class="col-md-4">--}}
                    {{--<a href="{{ route('register') }}" class="btn btn-dark rounded-pill py-2 w-100 main-color">Sign Up</a>--}}
                {{--</div>--}}
                {{--<div class="col-md-2"></div>--}}
            {{--@endif--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</section>--}}

<section class="analyze mb-5">
    <div class="container-fluid">
        <div class="row">
            <div class="header analyzing-header">
                <div class="inner-header flex mt-4">
                    <h1 class="my-md-5 main-text-color">Start Analyzing With</h1>
                    <div class="col-12">
                        <div class="row no-gutters">
                            <div class="col-md-2">
                                <a href="https://www.dataresources-bd.com/Commodity" class="btn rounded-0 main-text-color ash-btn-color my-2 w-100" target="_blank">Commodity</a>
                            </div>
                            <div class="col-md-2">
                                <a href="https://www.dataresources-bd.com/Vehicle" class="btn rounded-0 main-color text-white my-2 w-100" target="_blank">Vehicle</a>
                            </div>
                            <div class="col-md-2">
                                <a href="https://www.dataresources-bd.com/Monthly%20Macro" class="btn rounded-0 main-text-color ash-btn-color my-2 w-100" target="_blank">Monthly Macro</a>
                            </div>
                            <div class="col-md-2">
                                <a href="https://www.dataresources-bd.com/Internet_Subscriber" class="btn rounded-0 main-color text-white my-2 w-100" target="_blank">Internet</a>
                            </div>
                            <div class="col-md-2">
                                <a href="https://www.dataresources-bd.com/Publication" class="btn rounded-0 main-text-color ash-btn-color my-2 w-100" target="_blank">Publication</a>
                            </div>
                            <div class="col-md-2">
                                <a href="https://www.dataresources-bd.com/Mobile_Subscriber" class="btn rounded-0 main-color text-white my-2 w-100" target="_blank">Mobile Subscriber</a>
                            </div>

                            <div class="col-md-2">
                                <a href="https://www.dataresources-bd.com/search?search=grameenphone" class="btn rounded-0 main-color text-white my-2 w-100" target="_blank">Grameenphone</a>
                            </div>
                            <div class="col-md-2">
                                <a href="https://www.dataresources-bd.com/search?search=brac+bank" class="btn rounded-0 main-text-color ash-btn-color my-2 w-100" target="_blank">BRAC Bank</a>
                            </div>
                            <div class="col-md-2">
                                <a href="https://www.dataresources-bd.com/search?search=bergerpbl" class="btn rounded-0 main-color text-white my-2 w-100" target="_blank">BergerPBL</a>
                            </div>
                            <div class="col-md-2">
                                <a href="https://www.dataresources-bd.com/search?search=reckitben" class="btn rounded-0 main-text-color ash-btn-color my-2 w-100" target="_blank">Reckittben</a>
                            </div>
                            <div class="col-md-2">
                                <a href="https://www.dataresources-bd.com/search?search=marico" class="btn rounded-0 main-color text-white my-2 w-100" target="_blank">Marico</a>
                            </div>
                            <div class="col-md-2">
                                <a href="https://www.dataresources-bd.com/search?search=esquire" class="btn rounded-0 main-text-color ash-btn-color my-2 w-100" target="_blank">Esquire knit</a>
                            </div>

                            <div class="col-md-2">
                                <a href="https://www.dataresources-bd.com/search?search=ifad+autos" class="btn rounded-0 main-text-color ash-btn-color my-2 w-100" target="_blank">Ifad Autos</a>
                            </div>
                            <div class="col-md-2">
                                <a href="https://www.dataresources-bd.com/search?search=OLYMPIC+INDU" class="btn rounded-0 main-color text-white my-2 w-100" target="_blank">Olympic</a>
                            </div>
                            <div class="col-md-2">
                                <a href="https://www.dataresources-bd.com/search?search=SUMMIT+POWER" class="btn rounded-0 main-text-color ash-btn-color my-2 w-100" target="_blank">Summit Power</a>
                            </div>
                            <div class="col-md-2">
                                <a href="https://www.dataresources-bd.com/search?search=IDLC" class="btn rounded-0 main-color text-white my-2 w-100" target="_blank">IDLC</a>
                            </div>
                            <div class="col-md-2">
                                <a href="https://www.dataresources-bd.com/search?search=SINGER" class="btn rounded-0 main-text-color ash-btn-color my-2 w-100" target="_blank">Singer</a>
                            </div>
                            <div class="col-md-2">
                                <a href="https://www.dataresources-bd.com/search?search=Bata+shoe" class="btn rounded-0 main-color text-white my-2 w-100" target="_blank">Bata Shoe</a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- <!--Waves Container-->
                <div>
                    <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 120 28" preserveAspectRatio="none" shape-rendering="auto">
                        <defs>
                            <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
                        </defs>
                        <g class="parallax">
                            <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(0, 172, 193, 1)" />
                            <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(84, 58, 183, 0.5)" />
                            <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(0, 172, 193, 0.3)" />
                            <use xlink:href="#gentle-wave" x="48" y="7" fill="rgba(84, 58, 183, 0.5)" />
                        </g>
                    </svg>
                </div>
                <!--Waves end--> --}}
            </div>
        </div>
    </div>
</section>


@if(count($survey_results)>0)
    <section class="survey" id="opinion">
        <div class="container h-100">
            <div class="row text-center align-items-center h-100">
                <div class="col-md-12">
                    <h1 class="mt-5 survey-margin-top">Your Opinion</h1>
                </div>

                @foreach ($survey_results as $survey)
                <div class="col-md-12">
                    {{-- <h5 class="main-text-color">{{$survey->title}}</h5> --}}
                </div>
                    @foreach($survey->surveyQuestions as $surveyQuestion)
                        <div class="col-md-12">
                            @include('front-end.home.survey-answer')
                        </div>
                    @endforeach
                @endforeach

            </div>
        </div>
    </section>
@endif
@if(count($surveys)>0)
    <section class="survey" id="opinion">
        <div class="container h-100">
            <div class="row text-center align-items-center h-100">
                <div class="col-md-12">
                    <h4 class="mt-md-5 survey-margin-top">Participate in Survey</h4>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        @foreach ($surveys as $survey)
                            <!-- <h5 class="main-text-color">{{$survey->title}}</h5> -->

                            @foreach($survey->surveyQuestions as $surveyQuestion)
                                <div class="col-md-6">
                                    @if(auth()->user())
                                        @if(auth()->user()->canSubmitResponse($surveyQuestion))
                                            @include('front-end.home.survey-answer-form')
                                        @else
                                            <h5 class="my-3 text-left submitted-question-answer">Question: {{ $surveyQuestion->question }}</h5>
                                            <p class="my-3 text-left submitted-question-answer">Thank you for taking the survey</p>
                                        @endif
                                    @else
                                        @include('front-end.home.survey-answer-form')
                                    @endif<br>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif


{{--<section id="pricing" class="pricing py-5 bg-light" >--}}
{{--    <h1 class="text-center main-text-color mb-md-5">Our Pricing</h1>--}}
{{--    <div class="container-fluid">--}}
{{--      <div class="row" id="mycheckbox">--}}
{{--          <button @click="test()">test</button>--}}
{{--        <div class="col-md-12">--}}
{{--            <div class="card-group">--}}
{{--                <div class="card mr-sm-3 pricing-card-border-radius pricing-card-border-top d-none d-sm-block">--}}
{{--                    <div class="card-body text-center">--}}
{{--                        <h5 class="mt-4 card-title text-uppercase">Features</h5>--}}
{{--                        <p class="price-text mt-5">News Aggregator</p>--}}
{{--                        <p class="price-text">Data Matrix</p>--}}
{{--                        <p class="price-text">Download Data</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="card mr-sm-3 pricing-card-border-radius pricing-card-border-top">--}}
{{--                    <div class="card-body text-center">--}}
{{--                        <h6 class="card-title text-uppercase">Basic</h6>--}}
{{--                        <p class="font-weight-bold price-text-2">BDT 0/<br>month</p>--}}
{{--                        <hr class="small d-block d-sm-none">--}}
{{--                        <p class="price-text"><i class="fas fa-check d-none d-sm-block"></i><span class="small d-block d-sm-none">News Aggregator</span></p>--}}
{{--                        <p class="price-text"><i class="fas fa-check d-none d-sm-block"></i><span class="small d-block d-sm-none">Data Matrix</span></p>--}}
{{--                        <p class="price-text"><b class="d-none d-sm-block">10</b><span class="small d-block d-sm-none">10 Downloads</span></p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                @foreach ($subscriptionplans as $subscriptionplan)--}}
{{--                <div class="card mr-sm-3 pricing-card-border-radius pricing-card-border-top">--}}
{{--                    <div class="card-body text-center">--}}
{{--                        <h6 class="card-title text-uppercase">{{ $subscriptionplan->name}} <small>({{ $subscriptionplan->user_limit }} User)</small></h6>--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-6">--}}
{{--                                <p class="font-weight-bold price-text-2">BDT {{ number_format($subscriptionplan->price_per_month) }}/<br>month</p>--}}
{{--                                <hr class="small d-block d-sm-none">--}}
{{--                                <p class="price-text"><i class="fas fa-check d-none d-sm-block"></i><span class="small d-block d-sm-none">News Aggregator</span></p>--}}
{{--                                <p class="price-text"><i class="fas fa-check d-none d-sm-block"></i><span class="small d-block d-sm-none">Data Matrix</span></p>--}}
{{--                                <p class="price-text"><b class="d-none d-sm-block">Unlimited</b><span class="small d-block d-sm-none">Unlimited Downloads</span></p>--}}
{{--                                @if(auth()->user())--}}
{{--                                    --}}{{-- <form  method="post" action="{{ route('subscribe.plan') }}">--}}
{{--                                        @csrf --}}
{{--                                        --}}{{-- <input type="hidden" name="price" value="{{ $subscriptionplan->price_per_month }}">--}}
{{--                                        <input type="hidden" name="plan_id" value="{{ $subscriptionplan->id }}">--}}
{{--                                        <input type="hidden" name="type" value="monthly">--}}
{{--                                        <input type="hidden" name="user_limit" value="{{ $subscriptionplan->user_limit }}"> --}}
{{--                                        @include('front-end.home.partial.monthlyagreement')--}}
{{--                                        <button type="button" class="btn btn-outline-warning btn-sm" data-toggle="modal" data-target="#monthlyexampleModal{{ $subscriptionplan->id }}">Get Started</button>--}}
{{--                                    --}}{{-- </form> --}}
{{--                                @else--}}
{{--                                    <td><a href="/login" class="btn btn-warning">Login</a></td>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                            <div class="col-6">--}}
{{--                                <p class="font-weight-bold price-text-2">BDT {{ number_format($subscriptionplan->price_per_year) }}/year<br><span class="text-warning">{{ intval($subscriptionplan->discount($subscriptionplan->price_per_month , $subscriptionplan->price_per_year)) }}% Discount</span></p>--}}
{{--                                <hr class="small d-block d-sm-none">--}}
{{--                                <p class="price-text"><i class="fas fa-check d-none d-sm-block"></i><span class="small d-block d-sm-none">News Aggregator</span></p>--}}
{{--                                <p class="price-text"><i class="fas fa-check d-none d-sm-block"></i><span class="small d-block d-sm-none">Data Matrix</span></p>--}}
{{--                                <p class="price-text"><b class="d-none d-sm-block">Unlimited</b><span class="small d-block d-sm-none">Unlimited Downloads</span></p>--}}
{{--                                @if(auth()->user())--}}
{{--                                    --}}{{-- <form  method="post" action="{{ route('subscribe.plan') }}">--}}
{{--                                        @csrf--}}
{{--                                        <input type="hidden" name="price" value="{{ $subscriptionplan->price_per_year }}">--}}
{{--                                        <input type="hidden" name="plan_id" value="{{ $subscriptionplan->id }}">--}}
{{--                                        <input type="hidden" name="type" value="yearly">--}}
{{--                                        <input type="hidden" name="user_limit" value="{{ $subscriptionplan->user_limit }}"> --}}
{{--                                        @include('front-end.home.partial.yearlyagreement')--}}
{{--                                        <button type="button" class="btn btn-outline-warning btn-sm" data-toggle="modal" data-target="#yearlyexampleModal{{ $subscriptionplan->id }}">Get Started </button>--}}

{{--                                    --}}{{-- </form> --}}
{{--                                @else--}}
{{--                                    <td><a href="/login" class="btn btn-warning">Login</a></td>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        </div>--}}
{{--      </div>--}}
{{--    </div>--}}
{{--</section>--}}


<section id="who-we-are" class="call-to-action bg-warning">
    <div class="container-fluid h-100">
        <div class="row text-center align-items-center h-100">
            @if (Auth::user())
                <div class="col-md-12">
                    <h1 class="main-text-color">Data Resources BD</h1>
                </div>
            @else
                <div class="col-md-2"></div>
                <div class="col-md-4">
                    <h1 class="main-text-color">Sign Up for Free</h1>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('register') }}" class="btn btn-dark rounded-pill py-2 w-100 main-color">Sign Up</a>
                </div>
                <div class="col-md-2"></div>
            @endif
        </div>
    </div>
</section>

<section class="contact-us pb-5">
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-6 main-text-color border-right">
                <h1>Who We Are</h1>
                <p class="main-text-color">Data Resources BD aims to provide accurate and workable data to help you make e best investment decision. All the data are collected from secondary source.
                </p>
            </div>
            <div class="col-md-6">
                <h1 class="main-text-color"  @click="isShowButton()">Contact Us</h1>
                <form action="{{route('contactus')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" placeholder="Message" name="body"></textarea>
                    </div>
                    <button class="btn btn-dark py-2 w-100 main-color" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
{{--@section('scripts')--}}
{{--<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>--}}
{{--<script >--}}
{{--    var mycheckbox = new Vue({--}}
{{--        el: '#mycheckbox',--}}
{{--        data() {--}}
{{--            return {--}}
{{--                isButton: false,--}}
{{--            }--}}

{{--        },--}}
{{--         methods: {--}}
{{--            isShowButton: function(){--}}
{{--                console.log('hello');--}}
{{--               this.isButton = !this.isButton;--}}
{{--            },--}}
{{--             test: function() {--}}
{{--                console.log('hi');--}}
{{--             }--}}
{{--         },--}}
{{--    })--}}
{{--</script>--}}
{{--@endsection--}}

