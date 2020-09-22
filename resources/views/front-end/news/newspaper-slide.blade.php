<section>
    <div class="container-fluid custom-news-header-top">
        <ul id="news-topbar-owl-carousel" class="owl-carousel news-top-slider">
            @foreach($newspapers as $paper)
                <li><a href="{{route('news.bynewspaper', $paper->id)}}">{{$paper->name}}</a></li>
            @endforeach
        </ul>
    </div>
</section>