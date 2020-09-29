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

    <section class="news" id="app">
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
                <div class="col-12 col-md-8 mt-3">


                    <!-- ///////////////////////////////////////////////// -->

                    <ul id="example-2" style="margin: 0; padding: 0;">
                        <div v-if="initial" v-for="item in initial" :key="item.id + Math.random()">
                            <div class="shadow-sm mb-3 single-news-border">
                                <div class="row" v-bind:id="item.id">
                                    <div class="col-md-9">
                                        <a :href="item.source" target="_blank"><h5>@{{item.heading}}</h5></a>
                                        <a :href="item.source" target="_blank"><p class="text-justify word-break">
                                                @{{item.body}} | <span class="text-secondary small">@{{item.human_readable_time}}</span>
                                            </p></a>
                                    </div>
                                    <div class="col-md-3" v-if="item.image">
                                        <a :href="item.source" target="_blank">
                                            <img v-bind:src="getImageUrl(item.image)"
                                                 class="mb-3 img-fluid news-index-img" alt="...">
                                        </a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="ml-auto pr-2 responsive-share-btns">
                                        <div class="addthis_inline_share_toolbox news-share-buttons" :data-url="'{{ env('APP_URL') }}/single-news/' + item.id" :data-title="item.heading" :data-description="item.body" :data-media="'{{ env('S3_URL') }}' + item.image"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </ul>
                </div>


                <div class="col-12 col-md-2 mt-3">
                    <div class="financial_side_add mb-3">
                        <p>Add</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script>
        var example2 = new Vue({
            el: '#example-2',
            data() {
                return {
                    last_id: 0,
                    threshold: 300,
                    count: 0,
                    content: [],
                    initial: [],
                    latest_call: [],
                    isShowComment: null,
                    isShowCommentBox: null,
                    url: "{{ env('APP_URL') }}",
                    route: "/comment/",
                    @if(Auth::check())
                    isAuth: {{ Auth::check()}},
                    userId: {{ Auth::user()->id}},
                    @else
                    isAuth: null,
                    @endif
                }
            },
            mounted() {
                this.initial_call();
                this.isShowComment = localStorage.isShowComment;
            },
            created() {
                window.addEventListener('scroll', this.handleScroll);
            },
            destroyed() {
                window.removeEventListener('scroll', this.handleScroll);
            },
            methods: {
                loadDynamicContent: function () {
                    addthis.layers.refresh();
                },
                getUrl: function (item) {
                    let url = this.url;
                    url = url + '/single-news/' + item.id;
                    return (url);
                },
                getTitle: function (item) {
                    return item.heading;
                },
                getDescription: function (item) {
                    return item.body;
                },
                isshowcomment: function (index) {
                    this.isShowComment = index;
                    localStorage.isShowComment = index;
                },

                isComment: function (index) {
                    this.isShowCommentBox = index;
                },

                getImageUrl(name) {
                    return "https://data-resources-bd.s3-ap-southeast-1.amazonaws.com/" + name;
                },
                isshowcomment: function (index) {
                    this.isShowComment = index;
                    localStorage.isShowComment = index;
                },

                isComment: function (index) {
                    this.isShowCommentBox = index;
                },

                getImageUrl(name) {
                    return "https://data-resources-bd.s3-ap-southeast-1.amazonaws.com/" + name;
                },

                handleScroll(event) {
                    //console.log(window.scrollY);
                    if (window.scrollY > this.threshold) {
                        this.call();
                        if (this.latest_call != []) {
                            this.initial = this.initial.concat(this.latest_call);
                            this.loadDynamicContent();
                            this.threshold = this.threshold + 300;
                        }
                    }
                    ;
                },
                call() {
                    //console.log("calling");
                    if (this.last_id == "none") {
                        console.log('no call');
                        return;
                    }
                    let url = '/api/news-for-you/last_id/' + this.last_id;
                    fetch(url, {
                        method: 'Post', // *GET, POST, PUT, DELETE, etc.
                        mode: 'cors', // no-cors, cors, *same-origin
                        cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
                        credentials: 'same-origin', // include, *same-origin, omit
                        headers: {
                            'Content-Type': 'application/json',
                            'Authorization': 'Bearer ' + localStorage.access_token,
                            // 'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        redirect: 'follow', // manual, *follow, error
                        referrer: 'no-referrer', // no-referrer, *client
                        body: JSON.stringify({
                            'categories' : {{$filter->category_id}},
                            'newspapers' : {{$filter->newspaper_id}},
                            'language' : '{{$filter->language}}'
                        })

                    })
                        .then(function (response) {
                            return response.json();
                        })
                        .then(response => {
                            if (response.success == true) {
                                this.latest_call = response.items;
                                this.last_id = response.last_id;
                            } else {
                                this.latest_call = [];
                                this.last_id = "none";
                            }
                        });
                },

                initial_call() {
                    let url = '/api/news-for-you/last_id/' + this.last_id;

                    console.log(url);
                    fetch(url, {
                        method: 'Post', // *GET, POST, PUT, DELETE, etc.
                        mode: 'cors', // no-cors, cors, *same-origin
                        cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
                        credentials: 'same-origin', // include, *same-origin, omit
                        headers: {
                            'Content-Type': 'application/json',
                            'Authorization': 'Bearer ' + localStorage.access_token,
                            // 'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        redirect: 'follow', // manual, *follow, error
                        referrer: 'no-referrer', // no-referrer, *client
                        body: JSON.stringify({
                            'categories' : {{$filter->category_id}},
                            'newspapers' : {{$filter->newspaper_id}},
                            'language' : '{{$filter->language}}'
                        })

                    })
                        .then(res => res.json())
                        .then(data => {
                                console.log(data)
                            this.initial = data.items;
                            this.last_id = data.last_id;
                        });
                }
            },
        })
    </script>


@endsection
