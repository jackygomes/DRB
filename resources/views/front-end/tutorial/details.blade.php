@extends('front-end.main-layout')

@section('content')
    <style type="text/css">
        .single-news-border p {
            margin-bottom: 0;
            font-size: 14px;
        }
        .price span {
            color:#4758a8;
            font-weight: bold;
        }
        .text-secondary span {
            color: #4758a8;
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
                        <div class="mb-3">
                            <div class="row">

                                @if(Session::has('success'))
                                <div class="col-md-4 offset-4">
                                    <div class="alert alert-success" role="alert">
                                        {{Session::get('success')}}
                                    </div>
                                </div>
                                @endif

                                {{--left section--}}
                                <div class="col-md-5">
                                    <div class="single-news-border">
                                        <img width="100%" src="{{asset('storage/tutorial/' . $tutorial->tutorial_image)}}" alt="..." class="img-fluid news-index-img">

                                        <div class="row mt-3">
                                            <div class="col-6">
                                                <p style="font-weight: 600;">Price : {{$tutorial->price}} BDT</p>
                                                <p><small>Time: {{$dateOrganizer->makePrettyDate($tutorial->date)}}</small></p>
                                            </div>
                                            <div class="col-6 text-right">
                                                @if(auth()->user())
                                                    @if(!App\User::hasRegisteredOnThisTutorial($tutorial->id))
                                                        <a href="{{ route('tutorials.payment', $tutorial->id) }}" class="btn btn-warning btn-sm my-2 my-sm-0 mx-1"> Register</a>
                                                    @else
                                                        <a href="javascript:void(0)" class="btn btn-success btn-sm my-2 my-sm-0 mx-1"> Registered</a>
                                                    @endif
                                                @else
                                                    <a href="{{URL::to('/login')}}" class="btn btn-warning btn-sm my-2 my-sm-0 mx-1"> Login</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                {{--right section--}}

                                <div class="col-md-7">
                                    <h2>{{$tutorial->name}}</h2>

                                    <div class="description mt-4">
                                        <h5>Description</h5>
                                        <p style="text-align: justify; font-size: 16px;">{{$tutorial->description}}</p>
                                    </div>

                                    <div class="trainers mt-4">
                                        <h5>Trainers</h5>
                                        <p style="">{{implode(', ', json_decode($tutorial->trainers))}}</p>
                                    </div>

                                    <div class="curriculum mt-4">
                                        <h5>Curriculum</h5>
                                        <p style="">{{$tutorial->curriculum}}</p>
                                    </div>

                                    <div class="requirement mt-4">
                                        <h5>Requirement</h5>
                                        <p style="">{{$tutorial->requirement}}</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                </div>
            </div>
        </div>
    </section>

@endsection