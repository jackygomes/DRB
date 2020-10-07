@extends('front-end.main-layout')
@section('content')

    <section>
        <div class="container-fluid custom-news-header-top">
            <div class="row">
                <div class="col-8 offset-2">
                    {{--add section--}}
                    <div class="financial_top_add mb-3">
                        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                        <!-- Horizontal unit -->
                        <ins class="adsbygoogle"
                             style="display:block"
                             data-ad-client="ca-pub-7889950300474908"
                             data-ad-slot="9066843834"
                             data-ad-format="auto"
                             data-full-width-responsive="true"></ins>
                        <script>
                            (adsbygoogle = window.adsbygoogle || []).push({});
                        </script>
                    </div>
                </div>
            </div>
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

                    <div class="col-md-6 offset-2 col-12 p-4 mt-3" style="box-shadow: 0 0 4px #c5c5c5;">
                        <p class="text-center">Get Your Favorite News</p>
                        <hr>

                        <div class="text-center">
                            <a class="btn btn-outline-warning" style="background: #5b5b65; color: #fff; border-color: #ffc107;" href="{{route('login')}}">Sign In</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection