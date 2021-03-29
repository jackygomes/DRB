<div class="col-md-12">
    <button type="button" id="sidebarCollapse"
            class="btn btn-warning my-2 d-md-none news-toggle-button news-sidenav-scroll-hide sidebar_margin_top">
        <i id="news-sidenav" class="fas fa-chevron-right"></i>
        <span>Data Resource BD</span>
    </button>
</div>
<div class="col-12 col-md-2">
    <div class="wrapper">
        <!-- Sidebar  -->
        {{--news-sidenav-scroll-hide--}}
        <nav id="sidebar"
             class="bg-transparent text-dark custom-news-nav-header-top sidebar_margin_top_index_page" style="width: 235px;">

            <ul class="list-unstyled components">
                <li class="{{ request()->url() == route('newsletters.index') ? 'news-sidenav-active' : '' }}">
                    <a class="news-sidenav-hover" href="{{route('newsletters.index')}}">All Newsletters</a>
                </li>

                @foreach ($newsletterCategories as $newsletterCategory)
                    {{--@dd(request()->url() == route('newsletters.by.category', $newsletterCategory->id))--}}
                    <li class="{{ request()->url() == route('newsletters.index', $newsletterCategory->id) ? 'news-sidenav-active' : '' }}">
                        <a class="news-sidenav-hover"
                           href="{{route('newsletters.index', $newsletterCategory->id)}}">{{ $newsletterCategory->category }}</a>
                    </li>
                @endforeach
            </ul>
        </nav>
    </div>
</div>