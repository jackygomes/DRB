@extends('front-end.main-layout')
@section('content')

    @include('front-end.news.newspaper-slide')

    {{--<section>--}}
        {{--<div class="container-fluid">--}}
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
        {{--</div>--}}
    {{--</section>--}}

    <section class="news" id="app">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    {{-- <h3>News</h3> --}}
                    <button type="button" id="sidebarCollapse"
                            class="btn btn-warning my-2 d-md-none news-toggle-button news-sidenav-scroll-hide">
                        <i id="news-sidenav" class="fas fa-chevron-right"></i>
                        <span>Data Resource BD</span>
                    </button>
                </div>
                <div class="col-12 col-md-2">
                    <div class="wrapper">
                        <!-- Sidebar  -->
                        {{--news-sidenav-scroll-hide --}}
                        <nav id="sidebar"
                             class="bg-transparent text-dark " style="margin-top: -30px; width: 235px; overflow: hidden;">

                            <ul class="list-unstyled components" style="margin-top: 185px;">
                                <li class="{{ request()->url() == route('news.index') ? 'news-sidenav-active' : '' }}">
                                    <a href="{{route('news.index')}}">All News</a>
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
                <div class="col-12 col-md-7">


                    <!-- ///////////////////////////////////////////////// -->

                    <ul id="example-1" style="margin-top: 25px; padding: 0;">
                        <div v-for="item in initial" :key="item.id + Math.random()">
                            <div class="shadow-sm mb-3 single-news-border">
                                <div class="row" v-bind:id="item.id">
                                    <div class="col-md-9">
                                        <a :href="'/single-news/' + item.id" target="_blank"><h5>@{{item.heading}}</h5></a>
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
                                    <div class="ml-auto pr-2">
                                        <div class="addthis_inline_share_toolbox news-share-buttons" :data-url="'{{ env('APP_URL') }}/single-news/' + item.id" :data-title="item.heading" :data-description="item.body" :data-media="'{{ env('S3_URL') }}' + item.image"></div>
                                    </div>
                                </div>
                                {{--<div class="row">--}}
                                {{-- @if(@{{item.comments.length}} > 0 || Auth::check()) --}}
                                {{--<div v-if="isAuth || item.comments.length > 0" class="col-md-12 mb-n4" >--}}
                                {{--<button type="button" class="btn btn-light btn-sm mb-3 border border-secondary comment-btn-top" @click='isshowcomment(item.id)'><i class="far fa-comment-alt"></i> Comment</button>--}}
                                {{--</div>--}}
                                {{-- @endif     --}}
                                {{--<div class="ml-auto pr-2 news-share-button-mobile">--}}
                                {{--<div class="addthis_inline_share_toolbox news-share-buttons" :data-url="getUrl(item)" :data-title="getTitle(item)" :data-description="getDescription(item)" :data-media="getImageUrl(item.image)"></div>--}}
                                {{--</div>--}}
                                {{--</div>    --}}
                                {{--<div class="comment-field-top" v-if='isShowComment == item.id'>--}}
                                {{--@if (Auth::check())--}}
                                {{--<form method="POST" action="{{ route('comment.store') }}">--}}
                                {{--@csrf--}}
                                {{--<div class="row mb-n2">--}}
                                {{--<div class="col-9 col-md-10">--}}
                                {{--<div class="form-group">--}}
                                {{--<textarea class="form-control" id="exampleFormControlTextarea1" name="body" rows="1" placeholder="Write a comment..."></textarea>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="col-3 col-md-2">--}}
                                {{--<input type="hidden" name="news_id" v-bind:value="item.id">--}}
                                {{--<button type="submit" class="btn btn-warning w-100 float-right"><i class="fas fa-check d-xl-none"></i> <span class="d-none d-xl-block">Submit</span></button>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--</form>--}}
                                {{--@endif    --}}
                                {{--<ul class="list-group">--}}
                                {{-- @foreach ($news->comments as $comment) --}}
                                {{--<div v-for="comment in item.comments" :key="comment.id + Math.random()">--}}
                                {{--<li class="list-group-item rounded small border-0 mb-1 bg-light">--}}
                                {{--<b>@{{comment.user_id != null ? comment.username : 'Anonymous'}}:</b> --}}
                                {{--<span v-if="isShowCommentBox == comment.id">--}}
                                {{--<form method="POST" :action="route + comment.id">--}}
                                {{--@csrf--}}
                                {{--@method('patch')--}}
                                {{--<div class="row">--}}
                                {{--<div class="col-9 col-md-10">--}}
                                {{--<div class="form-group">--}}
                                {{--<textarea class="form-control mr-5" id="exampleFormControlTextarea1" name="body" rows="1" placeholder="Write a comment..." :value="comment.body"></textarea>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="col-3 col-md-2">--}}
                                {{--<input type="hidden" name="news_id" v-bind:value="item.id">--}}
                                {{--<button type="submit" class="btn btn-warning w-100 float-right"><i class="fas fa-check d-xl-none"></i> <span class="d-none d-xl-block">Update</span></button>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--</form>--}}
                                {{--</span> --}}
                                {{--<span v-else>@{{comment.body}}</span>--}}
                                {{--<div class="row">--}}
                                {{--<div class="col-md-6">--}}
                                {{--<span class="text-secondary news-comment-time-text mt-n3">@{{comment.human_readable_time}}</span>--}}
                                {{--</div>--}}
                                {{--<div class="col-md-6 text-right">--}}
                                {{--@if(Auth::user())--}}
                                {{-- @if(Auth::user()->id == 1)  --}}
                                {{--<diV v-if="userId == comment.user_id">--}}
                                {{--<button class="bg-transparent border-0 small text-secondary" @click="isComment(comment.id)"  v-if="isShowCommentBox != comment.id">edit</button>--}}
                                {{--<button class="bg-transparent border-0 small text-secondary" @click="isComment(null)"  v-if="isShowCommentBox == comment.id">Cancel</button>--}}
                                {{--<form :action="route + comment.id" onclick="return confirm('Are you sure, you want to delete this Comment?')" method="post" style="display: inline;" v-if="isShowCommentBox != comment.id">--}}
                                {{--@csrf--}}
                                {{--@method('delete')--}}
                                {{--<button type="submit" class="bg-transparent border-0 small text-secondary">Delete</button>--}}
                                {{--</form>--}}
                                {{--</diV>--}}
                                {{-- @endif --}}
                                {{--@endif --}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--</li>--}}
                                {{-- @endforeach --}}
                                {{--</div>--}}
                                {{--</ul>--}}
                                {{--</div> --}}
                            </div>
                        </div>
                    </ul>
                </div>
                <!-- ////////////////////////////////////////////////// -->
                {{--<div class="col-12 col-md-3" style="margin-top: 25px;">--}}
                    {{--<h5>Most Recent</h5>--}}
                    {{--<div class="table-responsive most-recent-border mb-3">--}}
                        {{--<table class="table table-hover">--}}
                            {{--<thead>--}}
                            {{--<tr>--}}
                                {{--<th scope="col">Topic</th>--}}
                                {{--<th scope="col">Date</th>--}}
                            {{--</tr>--}}
                            {{--</thead>--}}
                            {{--<tbody>--}}
                            {{--@foreach ($mostrecents as $recent)--}}
                                {{--<tr>--}}
                                    {{--<td class="more">{!! nl2br($recent->body) !!}</td>--}}
                                    {{--<td>{{ date('F Y', strtotime($recent->date)) }}</td>--}}
                                {{--</tr>--}}
                            {{--@endforeach--}}
                            {{--</tbody>--}}
                        {{--</table>--}}
                    {{--</div>--}}
                {{--</div>--}}

                <div class="col-12 col-md-2 mt-3">
                    {{--add section--}}
                    <div class="financial_side_add mb-3">
                        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                        <!-- Vertical Unit -->
                        <ins class="adsbygoogle"
                             style="display:block"
                             data-ad-client="ca-pub-7889950300474908"
                             data-ad-slot="3467350027"
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

@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script>
        var example1 = new Vue({
            el: '#example-1',
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
                    //addthis.layers.refresh();
                },

                getUrl: function (item) {
                    let url = "{{ env('APP_URL') }}";
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

                handleScroll(event) {
//                    console.log(window.scrollY);
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
                    fetch('/api/news/last_id/' + this.last_id, {
                        method: 'Get', // *GET, POST, PUT, DELETE, etc.
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

                    })
                        .then(function (response) {
                            return response.json();
                        })
                        .then(response => {
                            if (response.success == true) {
                                this.latest_call = response.items;
                                this.last_id = response.last_id;
                                try{
                                    addthis.layers.refresh();
                                }catch(err) {
                                    console.log(err.message)
                                }
                            } else {
                                this.latest_call = [];
                                this.last_id = "none";
                            }
                        });
                },
                initial_call() {
                    fetch('/api/news/last_id/' + 0, {
                        method: 'Get', // *GET, POST, PUT, DELETE, etc.
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

                    })
                        .then(function (response) {
                            return response.json();
                        })
                        .then(response => {
                            this.initial = response.items;
                            this.last_id = response.last_id;
                            try{
                                try{
                                    addthis.layers.refresh();
                                }catch(err) {
                                    console.log(err.message)
                                }
                            }catch(err) {
                                console.log(err.message)
                            }
                        });
                }
            },
        })
    </script>


@endsection

{{--@endsection--}}
