    <div class="container">
        @include('front-end.search.financial')
        @include('front-end.search.page')
        @include('front-end.search.particular')
        
        <div class="card">
            <div class="card-header">
                News
            </div>
            <div class="card-body">
                @foreach($allnews as $news)
                    <div class="row">
                        <div class="col-md-2">
                            @if($news->image)
                                <a href="{{route('news.single',$news->id)}}">
                                    <img src="{{ env('S3_URL') }}{{$news->image}}" class="mr-3 img-fluid news-index-img" alt="...">
                                </a>
                            @endif
                        </div>
                        <div class="col-md-10">
                            <a href="{{route('news.single',$news->id)}}"><h5 class="pt-3 pt-md-0">{{ $news->heading }}</h5></a>
                            <a href="{{route('news.single',$news->id)}}"><p class="text-justify">{{ implode(' ', array_slice(explode(' ', strip_tags($news->body) ), 0, 70))}}</p></a>
                            <a href="{{route('news.single',$news->id)}}">See More ></a>
                        </div>
                    </div>
                    <hr>
                @endforeach
                <div class="col-md-12 mb-5">
                    <div class="row justify-content-center">
                        {{ $allnews->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>