@extends('front-end.main-layout')
@section('content')

<section class="news" id="app">
    <div class="container-fluid">
        <div class="row custom-news-header-top">
            <div class="col-md-12">
                {{-- <h3>News</h3> --}}
                <button type="button" id="sidebarCollapse" class="btn btn-warning my-2 d-md-none news-toggle-button news-sidenav-scroll-hide">
                    <i id="news-sidenav" class="fas fa-chevron-right"></i>
                    <span>Data Resource BD</span>
                </button>
            </div>
            <div class="col-md-2">
                <div class="wrapper">
                    <!-- Sidebar  -->
                    <nav id="sidebar" class="bg-transparent text-dark custom-news-nav-header-top news-sidenav-scroll-hide">
                
                        <ul class="list-unstyled components">
                            <li class="{{ request()->url() == route('news.index') ? 'news-sidenav-active' : '' }}">
                                <a href="{{route('news.index')}}">All News</a>
                            </li>
                            @foreach ($categories as $category)
                                <li class="{{ request()->url() == route('news.bycategoty', $category->name) ? 'news-sidenav-active' : '' }}">
                                    <a class="news-sidenav-hover" href="{{route('news.bycategoty', $category->name)}}">{{ $category->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="col-md-7">
                @if($allnews->count() == 0)
                    @if ($category != null)
                        <h3 class="text-center mt-5">There is no news in this category.</h3>
                    @else
                        <h3 class="text-center mt-5">Your search  did not match any news.</h3>
                    @endif
                @else
                    @foreach($allnews as $news)
                    <div class="shadow-sm mb-3 single-news-border">
                        <div class="row" id="{{$news->id}}">
                            <div class="col-md-9">
                                {{-- <a href="{{$news->source}}" target="_blank"><small class="pt-3 pt-md-0 news-comment-time-text text-secondary">{{ Str::limit ($news->source, 50) }}</small></a> --}}
                                <a href="{{$news->source}}" target="_blank"><h5>{{ $news->heading }}</h5></a>
                                <a href="{{$news->source}}" target="_blank"><p class="text-justify word-break">{{ implode(' ', array_slice(explode(' ', strip_tags($news->body) ), 0, 25))}} | <span class="text-secondary small">{{$news->updated_at->diffForHumans()}}</span></p></a>
                                {{-- <a href="{{route('news.single',$news->id)}}">See More ></a> --}}
                            </div>
                            <div class="col-md-3">
                                @if($news->image)
                                    <a href="{{$news->source}}" target="_blank">
                                        <img src="{{ env('S3_URL') }}{{$news->image}}" class="mb-3 img-fluid news-index-img" alt="...">
                                    </a>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            @if($news->comments->count() > 0 || Auth::check())
                                <div  class="col-md-12 mb-n4" >
                                    <button type="button" class="btn btn-light btn-sm mb-3 border border-secondary comment-btn-top" @click='isshowcomment({{$news->id}})'><i class="far fa-comment-alt"></i> Comment</button>
                                </div>
                            @endif    
                            {{-- <div  class="col-md-9"> --}}
                                {{-- <div class="text-right">
                                    <h6>Share</h6>
                                    <div class="addthis_inline_share_toolbox mx-auto" id="{{$news->id}}"></div>
                                </div> --}}
                                {{-- <div class="text-right">
                                    <div class="addthis_inline_share_toolbox news-share-buttons" data-url="{{ env('APP_URL') }}single-news/{{$news->id}}" data-title="{{$news->heading}}" data-description="{{$news->body}}" data-media="{{ env('S3_URL') }}{{$news->image}}"></div>
                                </div> --}}
                            {{-- </div> --}}
                            <div class="ml-auto pr-2">
                                <div class="addthis_inline_share_toolbox news-share-buttons" data-url="{{ env('APP_URL') }}single-news/{{$news->id}}" data-title="{{$news->heading}}" data-description="{{$news->body}}" data-media="{{ env('S3_URL') }}{{$news->image}}"></div>
                            </div>
                        </div>    
                        <div class="comment-field-top" v-if='isShowComment == {{$news->id}}'>
                            @if (Auth::check())
                                <form method="POST" action="{{ route('comment.store') }}">
                                    @csrf
                                    <div class="row mb-n2">
                                        <div class="col-8 col-md-10">
                                            <div class="form-group">
                                                <textarea class="form-control" id="exampleFormControlTextarea1" name="body" rows="1" placeholder="Write a comment..."></textarea>
                                            </div>
                                        </div>
                                        <div class="col-4 col-md-2">
                                            <input type="hidden" name="news_id" value="{{$news->id}}">
                                            <button type="submit" class="btn btn-warning w-100 float-right">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            @endif    
                            <ul class="list-group">
                                @foreach ($news->comments as $comment)
                                    <li class="list-group-item rounded small border-0 mb-1 bg-light">
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
                    @endforeach
                @endif    
            </div>
            <div class="col-md-3">
                <h5>Most Recent</h5>
                <div class="table-responsive most-recent-border">
                    <table class="table table-hover">
                        <thead>
                          <tr>
                            <th scope="col">Topic</th>
                            <th scope="col">Date</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($mostrecents as $recent)
                                <tr>
                                    <td class="more">{!! nl2br($recent->body) !!}</td>
                                    <td>{{ date('F Y', strtotime($recent->date)) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-12 my-5">
                <div class="row justify-content-center">
                    {{ $allnews->links() }}
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Customised date range</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               <form  method="GET">
                    <div class="form-group row">
                        <label for="example-date-input" class="col-4 col-form-label">Date From</label>
                        <div class="col-8">
                            <input class="form-control" type="date" value="{{ Request()->from}}" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-date-input" class="col-4 col-form-label">Date To</label>
                        <div class="col-8">
                            <input class="form-control" type="date" value="{{ Request()->to}}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Search</button>
                    </div>
                </form>
            </div>
            
            </div>
        </div>
    </div> --}}
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
