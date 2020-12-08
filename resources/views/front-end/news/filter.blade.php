@extends('front-end.main-layout')
@section('content')

    <section>
        <div class="container-fluid custom-news-header-top">
            {{--<div class="row">--}}
                {{--<div class="col-8 offset-2">--}}
                    {{--add section--}}
                    {{--<div class="financial_top_add mb-3">--}}
                        {{--<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>--}}
                        {{--<!-- Horizontal unit -->--}}
                        {{--<ins class="adsbygoogle"--}}
                             {{--style="display:block"--}}
                             {{--data-ad-client="ca-pub-7889950300474908"--}}
                             {{--data-ad-slot="9066843834"--}}
                             {{--data-ad-format="auto"--}}
                             {{--data-full-width-responsive="true"></ins>--}}
                        {{--<script>--}}
                            {{--(adsbygoogle = window.adsbygoogle || []).push({});--}}
                        {{--</script>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        </div>
    </section>

    <section class="news" style="min-height: 800px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 top-news-bar">
                    <button type="button" id="sidebarCollapse"
                            class="btn btn-warning my-2 d-md-none news-toggle-button news-sidenav-scroll-hide">
                        <i id="news-sidenav" class="fas fa-chevron-right"></i>
                        <span>Data Resource BD</span>
                    </button>
                </div>
                <div class="col-12 col-md-2">
                    <div class="wrapper">
                        <!-- Sidebar  -->
                        <nav id="sidebar"
                             class="bg-transparent text-dark custom-news-nav-header-top news-sidenav-scroll-hide" style="width: 235px; margin-top: 241px;">

                            <ul class="list-unstyled components">
                                <li class="{{ request()->url() == route('news.index') ? 'news-sidenav-active' : '' }}">
                                    <a class="news-sidenav-hover" href="{{route('news.index')}}">All News</a>
                                </li>

                                <li class="{{ request()->url() == route('filtered.news') ? 'news-sidenav-active' : '' }}">
                                    <a class="news-sidenav-hover" href="{{route('filtered.news')}}">For You</a>
                                </li>

                                @foreach ($categories as $category)
                                    <li class="{{ request()->url() == route('news.bycategoty', $category->name) ? 'news-sidenav-active' : '' }}">
                                        <a class="news-sidenav-hover"
                                           href="{{route('news.bycategoty', $category->name)}}">{{ $category->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </nav>
                    </div>
                </div>


                <div class="col-md-10">
                    <div class="row">
                        @if(count($errors) > 0 )
                            <div class="alert alert-danger alert-dismissible fade show col-md-4 offset-3" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <ul class="p-0 m-0" style="list-style: none;">
                                    @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>

                    <div class="col-md-8 offset-md-1 col-lg-6 offset-lg-2 col-sm-12 p-4 mt-3" style="box-shadow: 0 0 4px #c5c5c5;">
                        <p class="text-center">Get Your Favorite News</p>
                        <hr>

                        <form class="form-horizontal" action="{{route('news.for.you.post')}}" method="post">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <p class="mb-0">Newspapers :</p>
                                        @foreach($newspapers as $newspaper)
                                            <div class="form-check d-inline-block filter_item_design
                                                        @if($filter && $filter->newspaper_id)
                                                            {{(in_array($newspaper->id, json_decode($filter->newspaper_id))) ? 'filter_item_design_background' : ''}}
                                                            @endif
                                                ">
                                                <input
                                                        class="form-check-input position-static"
                                                        type="checkbox"
                                                        value="{{$newspaper->id}}"
                                                        name="newspapers[]"
                                                @if($filter && $filter->newspaper_id)
                                                    {{(in_array($newspaper->id, json_decode($filter->newspaper_id))) ? 'checked' : ''}}
                                                        @endif
                                                >
                                                <label class="form-check-label d-inline">{{$newspaper->name}}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <p class="mb-0">Categories :</p>
                                        @foreach($categories as $category)
                                            <div class="form-check d-inline-block filter_item_design
                                                @if($filter && $filter->category_id)
                                                    {{(in_array($category->id, json_decode($filter->category_id))) ? 'filter_item_design_background' : ''}}
                                                 @endif

                                            ">
                                                <input
                                                        class="form-check-input position-static"
                                                        type="checkbox"
                                                        value="{{$category->id}}"
                                                        name="categories[]"
                                                @if($filter && $filter->category_id)
                                                    {{(in_array($category->id, json_decode($filter->category_id))) ? 'checked' : ''}}
                                                        @endif
                                                >
                                                <label class="form-check-label d-inline">{{$category->name}}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group ">
                                        <p class="mb-0">Language:</p>
                                        <div class="form-check form-check-inline filter_item_design {{($filter && $filter->language == 'english') ? 'filter_item_design_background' : ''}}" style="padding-left: 10px">
                                            <input {{($filter && $filter->language == 'english') ? 'checked' : ''}} class="form-check-input" type="radio" name="language" id="inlineRadio1" value="english">
                                            <label class="form-check-label" for="inlineRadio1">English</label>
                                        </div>
                                        <div class="form-check form-check-inline filter_item_design {{($filter &&$filter->language == 'bangla') ? 'filter_item_design_background' : ''}} " style="padding-left: 10px">
                                            <input {{($filter &&$filter->language == 'bangla') ? 'checked' : ''}} class="form-check-input" type="radio" name="language" id="inlineRadio2" value="bangla">
                                            <label class="form-check-label" for="inlineRadio2">Bangla</label>
                                        </div>

                                        <div class="form-check form-check-inline filter_item_design {{($filter && $filter->language == 'both') ? 'selected' : ''}}" style="padding-left: 10px">
                                            <input {{($filter && $filter->language == 'both') ? 'checked' : ''}} class="form-check-input" type="radio" name="language" id="inlineRadio2" value="both">
                                            <label class="form-check-label" for="inlineRadio2">Both</label>
                                        </div>
                                    </div>
                                </div>
                            </div>




                            <div class="">
                                <button class="btn btn-warning" style="color: #fff;" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
    <script>

        $(document).ready(function(){
            $("input").click(function (event) {
               $(event.target).closest('div').addClass('filter_item_design_background')
            })
        })

    </script>
@endsection