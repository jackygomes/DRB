<div class="col-md-2 mobile-margin pl-0">
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar" class="bg-transparent text-dark custom-news-nav-header-top" style="width: 220px;">

            <ul class="list-unstyled components pt-0">

                <li class="{{ collect(request()->segments())->last() == 'view' ? 'news-sidenav-active' : '' }} mb-1">
                    <a class="{{ Request::get('provider') == '' ? 'news-sidenav-hover' : '' }} provider" data-name="" href="{{route('tutorials.view.index')}}">All Training</a>
                </li>

                @foreach($tutorialCategories as $tutorialCategory)
                    <li class="{{ (isset(collect(request()->segments())[2])) && collect(request()->segments())[2] ==  $tutorialCategory->id ? 'news-sidenav-active' : '' }} mb-1">
                        <a class="{{ Request::get('provider') == '' ? 'news-sidenav-hover' : '' }} provider" data-name="" href="{{route('tutorials.view.index', $tutorialCategory->id)}}">{{$tutorialCategory->name}}</a>
                    </li>
                @endforeach
            </ul>
        </nav>
    </div>
</div>