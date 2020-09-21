@extends('front-end.main-layout')
@section('content')

    <section>
        <div class="container-fluid custom-news-header-top">
            <div class="row">
                <div class="col-10 offset-1">
                    <div class="financial_top_add mb-3">
                        <p>Add</p>
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
                    <div class="col-md-6 offset-2 col-12 p-4 mt-3" style="box-shadow: 0 0 4px #c5c5c5;">
                        <p class="text-center">Get Your Favorite News First</p>
                        <hr>

                        <form class="form-horizontal" action="{{route('news.for.you.post')}}" method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="sel1">Newspaper :</label>
                                <select class="form-control" id="sel1" name="newspaper">
                                    <option value="">Select</option>

                                    @foreach($newspapers as $newspaper)
                                        <option value="{{$newspaper->id}}">{{$newspaper->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="sel2">Category :</label>
                                <select class="form-control" id="sel2" name="category">
                                    <option value="">Select</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}"> {{$category->name}} </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="text-center">
                                <button class="btn btn-warning" style="color: #fff;" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection