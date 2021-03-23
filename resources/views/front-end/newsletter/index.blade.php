@extends('front-end.main-layout')
@section('content')
    <section class="news" id="app">
        <div class="container-fluid">
            <div class="row">
                @include('front-end.newsletter.sidebar')

                <div class="col-md-10 offset-2">
                    <div id="app-two">
                        <div class="row" style="padding: 0; margin-top: 130px;">
                            <div v-if="initial" v-for="item in initial" :key="item.id + Math.random()" class="col-12 col-md-6 col-lg-4">
                                <div class="shadow-sm mb-3 single-news-border">
                                    <div class="row" v-bind:id="item.id">
                                        <div class="col-md-3" v-if="item.thumbnail">
                                            <img v-bind:src="getImageUrl(item.thumbnail)"
                                                 class="mb-3 img-fluid news-index-img" alt="...">
                                        </div>
                                        <div class="col-md-9">
                                            <a :href="'/single-news/' + item.id" target="_blank"><h5>@{{item.title}}</h5></a>
                                            <a :href="item.source" target="_blank"><p class="text-justify word-break">
                                                    @{{item.type}} | <span class="text-secondary small">@{{item.human_readable_time}}</span>
                                                </p></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

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
        var example2 = new Vue({
            el: '#app-two',
            data() {
                return {
                    last_id: 0,
                    canMakeCall : true,
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
                getUrl: function (item) {
                    let url = this.url;
                    url = url + '/single-news/' + item.id;
                    return (url);
                },

                getImageUrl(name) {
                    let url = "http://drb.localhost/storage/newsletter_thumbnail/" + name
                    console.log(url)
                    return url;
                },

                handleScroll(event) {
                    //console.log(window.scrollY);
                    if (window.scrollY > this.threshold) {
                        this.call();
                    }
                },
                {{--call() {--}}
                    {{--//console.log("calling");--}}
                    {{--if (this.last_id == "none") {--}}
                        {{--console.log('no call');--}}
                        {{--return;--}}
                    {{--}--}}
                    {{--let url = '/api/news/by-category/last_id/' + this.last_id + '/' + {{ $category_id }} ;--}}
                    {{--//console.log(url);--}}
                    {{--if(this.canMakeCall){--}}
                        {{--this.canMakeCall = false--}}
                        {{--fetch(url, {--}}
                            {{--method: 'Get', // *GET, POST, PUT, DELETE, etc.--}}
                            {{--mode: 'cors', // no-cors, cors, *same-origin--}}
                            {{--cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached--}}
                            {{--credentials: 'same-origin', // include, *same-origin, omit--}}
                            {{--headers: {--}}
                                {{--'Content-Type': 'application/json',--}}
                                {{--'Authorization': 'Bearer ' + localStorage.access_token,--}}
                                {{--// 'Content-Type': 'application/x-www-form-urlencoded',--}}
                            {{--},--}}
                            {{--redirect: 'follow', // manual, *follow, error--}}
                            {{--referrer: 'no-referrer', // no-referrer, *client--}}

                        {{--})--}}
                            {{--.then(function (response) {--}}
                                {{--return response.json();--}}
                            {{--})--}}
                            {{--.then(response => {--}}
                                {{--if (response.success == true) {--}}
                                    {{--//console.log(response.items)--}}
                                    {{--this.latest_call = response.items;--}}
                                    {{--this.last_id = response.last_id;--}}
                                    {{--if (this.latest_call != []) {--}}
                                        {{--this.initial = this.initial.concat(this.latest_call);--}}
                                        {{--this.threshold = this.threshold + 300;--}}

                                    {{--}--}}
                                    {{--this.canMakeCall = true;--}}
                                    {{--try{--}}
                                        {{--addthis.layers.refresh();--}}
                                    {{--}catch(err) {--}}
                                        {{--console.log(err.message)--}}
                                    {{--}--}}
                                {{--} else {--}}
                                    {{--this.latest_call = [];--}}
                                    {{--this.last_id = "none";--}}
                                {{--}--}}
                            {{--});--}}
                    {{--}--}}
                {{--},--}}

                initial_call() {
                    let url = '/newsletters/category/' + this.last_id;

                    console.log(url);
                    fetch(url, {
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
                        .then(res => res.json())
                        .then(data => {
                            this.initial = data.items;
                            this.last_id = data.last_id;
                            console.log(data)
                        });
                }
            },
        })
    </script>


@endsection
