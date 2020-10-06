@extends('front-end.main-layout')
@section('meta')
    <meta property="og:title" content="{{$news->heading}}" /> 
    <meta property="og:description" content="{{$news->body}}" />
    <meta property="og:image" content="{{ env('S3_URL') }}{{$news->image}}" />
@endsection
@section('content')
<!-- Navigation -->

{{-- <section class="news">
    <div class="container">
        <div class="row custom-header-top">
            <div class="col-md-12 mt-5">
                <h3>{{$news->heading}}</h3>
                <p class="card-text"><small class="text-muted">Posted on {{Carbon\Carbon::parse($news->created_at)->format('d F Y')}}</small></p>
            </div>
            <div class="col-md-12">
                @if($news->image)
                    <img src="{{ env('S3_URL') }}{{$news->image}}" class="img-fluid w-50 float-right pl-4" alt="...">
                @endif
                <p class="text-justify word-break">{!! nl2br($news->body) !!}</p>
            </div>
        </div>
    </div>
</section> --}}
<section class="news">
    <div class="container" id="app">
        <div class="row custom-header-top">

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

            <div class="col-md-12">
                <a href="{{route('news.index')}}" class="btn btn-outline-warning mb-3">All News</a>
                <div class="bg-light shadow-sm border-bottom border-warning mb-5">
                    <div class="row" id="{{$news->id}}">
                        <div class="col-md-5">
                            @if($news->image)
                                <a href="{{$news->source}}" target="_blank">
                                    <img src="{{ env('S3_URL') }}{{$news->image}}" class="mr-3 img-fluid news-index-img" alt="...">
                                </a>
                            @endif
                        </div>
                        <div class="col-md-7">
                            <a href="{{$news->source}}" target="_blank"><small class="pt-3 pt-md-0 news-comment-time-text text-secondary">{{ Str::limit ($news->source, 50) }}</small></a>
                            <a href="{{$news->source}}" target="_blank"><h6 class="pt-md-0">{{ $news->heading }}</h6></a>
                            {{-- <a href="{{$news->source}}" target="_blank"><p class="text-justify word-break">{{ implode(' ', array_slice(explode(' ', strip_tags($news->body) ), 0, 20))}}</p></a> --}}
                            {{-- <a href="{{route('news.single',$news->id)}}">See More ></a> --}}
                        </div>
                    </div>
                    <div class="row">
                        <div  class="col-md-3 mt-2">
                            <button type="button" class="btn btn-light btn-sm mb-3 border border-secondary" @click='isshowcomment({{$news->id}})'><i class="far fa-comment-alt"></i> Comment</button>
                        </div>
                    </div>    
                    <div>
                        @if (Auth::check())
                            <form method="POST" action="{{ route('comment.store') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-10">
                                        <div class="form-group">
                                            <textarea class="form-control mr-5" id="exampleFormControlTextarea1" name="body" rows="1" placeholder="Write a comment..."></textarea>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <input type="hidden" name="news_id" value="{{$news->id}}">
                                        <button type="submit" class="btn btn-warning w-100 float-right">Submit</button>
                                    </div>
                                </div>
                            </form>
                        @endif    
                        <ul class="list-group mb-3">
                            @foreach ($news->comments as $comment)
                                <li class="list-group-item rounded small border-0 mb-1">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <b>{{$comment->user_id != null ? $comment->user->full_name : 'Anonymous'}}:</b> 
                                            <span v-if="isShowCommentBox == {{$comment->id}}">
                                                <form method="POST" action="{{ route('comment.update', $comment->id) }}">
                                                    @csrf
                                                    @method('patch')
                                                    <div class="row">
                                                        <div class="col-10">
                                                            <div class="form-group">
                                                                <textarea class="form-control mr-5" id="exampleFormControlTextarea1" name="body" rows="1" placeholder="Write a comment...">{{$comment->body}}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-2">
                                                            <input type="hidden" name="news_id" value="{{$news->id}}">
                                                            <button type="submit" class="btn btn-warning w-100 float-right">Update</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </span> 
                                            <span v-else>{{$comment->body}}</span>
                                        </div>

                                        <div class="col-md-6">
                                            <span class="text-secondary news-comment-time-text mt-n3">{{$comment->updated_at->diffForHumans()}}</span>
                                        </div>

                                        <div class="col-md-6 text-right">
                                            @if(Auth::user())
                                                @if(Auth::user()->id == $comment->user_id) 
                                                    <button class="bg-transparent border-0 small text-secondary" @click="isComment({{$comment->id}})"  v-if="isShowCommentBox != {{$comment->id}}">Edit</button>
                                                    <button class="bg-transparent border-0 small text-secondary" @click="isComment(null)"  v-if="isShowCommentBox == {{$comment->id}}">Cancel</button>
                                                    <form action="{{ route('comment.destroy', $comment->id)}}" onclick="return confirm('Are you sure, you want to delete this Comment?')" method="post" style="display: inline;" v-if="isShowCommentBox != {{$comment->id}}">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="bg-transparent border-0 small text-secondary">Delete</button>
                                                    </form>
                                                @endif
                                            @endif  
                                        </div>
                                
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>     
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <h4 class="main-text-color">Latest News</h4>
                @foreach($latestNews as $news)
                    <div class="shadow-sm mb-3 p-4">
                        <div class="row">
                            <div class="col-md-9">
                                <a href="{{$news->source}}" target="_blank"><h5>{{$news->heading}}</h5></a>
                                <a href="{{$news->source}}" target="_blank">
                                    <p class="text-justify word-break">
                                        {{$news->body}} |
                                        <span class="text-secondary small">
                                            {{$news->human_readable_time}}
                                        </span>
                                    </p>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="{{$news->source}}" target="_blank">
                                    <img src="https://data-resources-bd.s3-ap-southeast-1.amazonaws.com/{{$news->image}}"
                                         class="mb-3 img-fluid news-index-img" alt="...">
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="ml-auto responsive-share-btns">
                                <div class="addthis_inline_share_toolbox news-share-buttons" data-url="'{{ env('APP_URL') }}/single-news/' + {{$news->id}}" data-title="{{$news->heading}}" data-description="{{$news->body}}" data-media="'{{ env('S3_URL') }}' + {{$news->image}}"></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

@section('scripts')
        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
        <script >
            var app = new Vue({
                el: '#app',
                data: {
                    isShowComment: null,
                    isShowCommentBox: null,
                    
                },
                mounted () {
                    this.isShowComment = localStorage.isShowComment ;
                },
                methods: {
                    isshowcomment: function(index){
                    this.isShowComment = index;
                    localStorage.isShowComment = index;
                    },

                    isComment: function(index){
                        this.isShowCommentBox = index;
                },
            }

            })
        </script>


    @endsection

@endsection
