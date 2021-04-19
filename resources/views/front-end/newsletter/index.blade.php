@extends('front-end.main-layout')
@section('content')
    <section class="news" id="app">
        <div class="container-fluid">
            <div class="row topmargin">
                @include('front-end.newsletter.subscribe-from')
            </div>
            <div class="row">
                @include('front-end.newsletter.sidebar')

                <div class="col-12 col-md-10 offset-md-2 mt-4">
                    <div id="app-two">
                        <div class="row">
                            <div class="col-md-4 offset-md-8">
                                <div class="input-group mb-3">
                                    <input type="date" class="form-control" v-model="publishing_date">
                                    <div class="input-group-append">
                                        <button class="btn btn-warning" type="button" @click="filterByPublishingDate">Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div v-if="initial" v-for="item in initial" :key="item.id + Math.random()" class="col-12 col-md-6">
                                <div class="shadow-sm mb-3 single-news-border">
                                    <div class="row" v-bind:id="item.id">
                                        <div class="col-lg-4" v-if="item.thumbnail">
                                            <img v-bind:src="getImageUrl(item.thumbnail)"
                                                 class="img-fluid newsletter_image" alt="..."  width="100%">
                                        </div>
                                        <div class="col-lg-8 d-flex align-items-center">
                                            <div class="newsletter_overview">
                                                <p><a :href="'/newsletters/single-newsletter/' + item.id" target="_blank"><h5 class="mb-0">@{{item.title}}</h5></a></p>
                                                <p><a :href="item.source" target="_blank" class="type_style">@{{item.category.type}}</a></p>
                                                <p><h5 class="mb-0">@{{item.readable_publishing_date}}</h5></p>
                                            </div>
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
                    publishing_date : '',
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
                filterByPublishingDate: function () {
                    if(this.publishing_date !== ''){
                        this.last_id = 0
                        this.initial_call()
                    }
                },
                getUrl: function (item) {
                    let url = this.url;
                    url = url + '/single-news/' + item.id;
                    return (url);
                },

                getImageUrl(name) {
                    let url = "{{env('S3_URL')}}" + "{{env('APP_ENV')}}" + "/newsletter/" + name
                    return url;
                },

                handleScroll(event) {
                    //console.log(window.scrollY);
                    if (window.scrollY > this.threshold) {
                        this.call();
                    }
                },
                call() {
                    //console.log("calling");
                    if (this.last_id == "none") {
                        //console.log('no call');
                        return;
                    }
                    let url = '/newsletters/category/' + this.last_id + '/' + {{ $categoryId }} + '/' + this.publishing_date;
                    //console.log(this.canMakeCall);
                    if(this.canMakeCall){
                        this.canMakeCall = false
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
                            .then(function (response) {
                                return response.json();
                            })
                            .then(response => {
                                //console.log(response)
                                if (response.success === true) {
                                    this.latest_call = response.items;
                                    this.last_id = response.last_id;
                                    if (this.latest_call != []) {
                                        this.initial = this.initial.concat(this.latest_call);
                                        this.threshold = this.threshold + 300;
                                    }
                                    this.canMakeCall = true;
                                }else if(response.date_search){
                                    this.canMakeCall = true;
                                }else {
                                    this.latest_call = [];
                                    this.last_id = "none";
                                }
                            });
                    }
                },

                initial_call() {
                    let url = '/newsletters/category/' + this.last_id + '/' + {{ $categoryId }} + '/' + this.publishing_date;
//                    console.log(url)
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
                        });
                }
            },
        })
    </script>


@endsection

@section('styles')
    <style>
        .type_style{
            background: #101c53;
            border-radius: 3px;
            padding: 0px 10px;
            text-transform: capitalize;
            color: #ffc107 !important;
        }
        .topmargin{
            margin-top: 97px;
        }

        /*used in subscriber page*/
        .subscribe{
            background: #f5f5f5;
            padding: 30px 0 40px 0;
        }

        /*used in sidebar page*/
        .sidebar_margin_top_index_page{
            margin-top: 300px;
        }
        .newsletter_image{max-height: 135px;}
        .newsletter_overview p{
            margin: 0;
        }

        @media only screen and (max-width: 768px) {
            .sidebar_margin_top_index_page{
                margin-top: 175px;
            }
        }

        @media only screen and (max-width: 768px) {
            .newsletter_overview{
                margin-top:15px;
            }

            .newsletter_image{max-height: 200px;}
        }
    </style>
@endsection
