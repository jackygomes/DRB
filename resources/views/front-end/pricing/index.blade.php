@extends('front-end.main-layout')
@section('content')
    <!-- Navigation -->
    <style>
        .pricing {
            margin-top: 150px;
            height: 100%;
        }
    </style>
    <section class="pricing mb-5">
        <h1 class="text-center main-text-color mb-md-5">Our Pricing</h1>
        <div class="container-fluid">
            <div class="row" id="mycheckbox">
                <div class="col-md-12">
                    <div class="card-group">
                        <div class="card mr-sm-3 pricing-card-border-radius pricing-card-border-top d-none d-sm-block">
                            <div class="card-body text-center">
                                <h5 class="mt-4 card-title text-uppercase">Features</h5>
                                <p class="price-text mt-5">News Aggregator</p>
                                <p class="price-text">Data Matrix</p>
                                <p class="price-text">Download Data</p>
                            </div>
                        </div>
                        <div class="card mr-sm-3 pricing-card-border-radius pricing-card-border-top">
                            <div class="card-body text-center">
                                <h6 class="card-title text-uppercase">Basic</h6>
                                <p class="font-weight-bold price-text-2">BDT 0/<br>month</p>
                                <hr class="small d-block d-sm-none">
                                <p class="price-text"><i class="fas fa-check d-none d-sm-block"></i><span class="small d-block d-sm-none">News Aggregator</span></p>
                                <p class="price-text"><i class="fas fa-check d-none d-sm-block"></i><span class="small d-block d-sm-none">Data Matrix</span></p>
                                <p class="price-text"><b class="d-none d-sm-block">10</b><span class="small d-block d-sm-none">10 Downloads</span></p>
                            </div>
                        </div>
                        @foreach ($subscriptionplans as $subscriptionplan)
                            <div class="card mr-sm-3 pricing-card-border-radius pricing-card-border-top">
                                <div class="card-body text-center">
                                    <h6 class="card-title text-uppercase">{{ $subscriptionplan->name}} <small>({{ $subscriptionplan->user_limit }} User)</small></h6>
                                    <div class="row">
                                        <div class="col-6">
                                            <p class="font-weight-bold price-text-2">BDT {{ number_format($subscriptionplan->price_per_month) }}/<br>month</p>
                                            <hr class="small d-block d-sm-none">
                                            <p class="price-text"><i class="fas fa-check d-none d-sm-block"></i><span class="small d-block d-sm-none">News Aggregator</span></p>
                                            <p class="price-text"><i class="fas fa-check d-none d-sm-block"></i><span class="small d-block d-sm-none">Data Matrix</span></p>
                                            <p class="price-text"><b class="d-none d-sm-block">Unlimited</b><span class="small d-block d-sm-none">Unlimited Downloads</span></p>
                                            @if(auth()->user())
                                                {{-- <form  method="post" action="{{ route('subscribe.plan') }}">
                                                    @csrf --}}
                                                {{-- <input type="hidden" name="price" value="{{ $subscriptionplan->price_per_month }}">
                                                <input type="hidden" name="plan_id" value="{{ $subscriptionplan->id }}">
                                                <input type="hidden" name="type" value="monthly">
                                                <input type="hidden" name="user_limit" value="{{ $subscriptionplan->user_limit }}"> --}}
                                                @include('front-end.home.partial.monthlyagreement')
                                                <button type="button" class="btn btn-outline-warning btn-sm" data-toggle="modal" data-target="#monthlyexampleModal{{ $subscriptionplan->id }}">Get Started</button>
                                                {{-- </form> --}}
                                            @else
                                                <td><a href="/login" class="btn btn-warning">Login</a></td>
                                            @endif
                                        </div>
                                        <div class="col-6">
                                            <p class="font-weight-bold price-text-2">BDT {{ number_format($subscriptionplan->price_per_year) }}/year<br><span class="text-warning">{{ intval($subscriptionplan->discount($subscriptionplan->price_per_month , $subscriptionplan->price_per_year)) }}% Discount</span></p>
                                            <hr class="small d-block d-sm-none">
                                            <p class="price-text"><i class="fas fa-check d-none d-sm-block"></i><span class="small d-block d-sm-none">News Aggregator</span></p>
                                            <p class="price-text"><i class="fas fa-check d-none d-sm-block"></i><span class="small d-block d-sm-none">Data Matrix</span></p>
                                            <p class="price-text"><b class="d-none d-sm-block">Unlimited</b><span class="small d-block d-sm-none">Unlimited Downloads</span></p>
                                            @if(auth()->user())
                                                {{-- <form  method="post" action="{{ route('subscribe.plan') }}">
                                                    @csrf
                                                    <input type="hidden" name="price" value="{{ $subscriptionplan->price_per_year }}">
                                                    <input type="hidden" name="plan_id" value="{{ $subscriptionplan->id }}">
                                                    <input type="hidden" name="type" value="yearly">
                                                    <input type="hidden" name="user_limit" value="{{ $subscriptionplan->user_limit }}"> --}}
                                                @include('front-end.home.partial.yearlyagreement')
                                                <button type="button" class="btn btn-outline-warning btn-sm" data-toggle="modal" data-target="#yearlyexampleModal{{ $subscriptionplan->id }}">Get Started </button>

                                                {{-- </form> --}}
                                            @else
                                                <td><a href="/login" class="btn btn-warning">Login</a></td>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script >
        $(function () {
            var mycheckbox = new Vue({
                el: '#mycheckbox',
                data() {
                    return {
                        isButton: false,
                    }
                },
                methods: {
                    isShowButton: function(){
                        console.log('hello');
                        this.isButton = !this.isButton;
                    },
                },
            })
        })

    </script>
@endsection
