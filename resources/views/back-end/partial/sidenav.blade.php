<!-- Sidebar  -->
<nav id="sidebar" style="width: auto;">
    <div class="sidebar-header">
        <a href="{{route('home')}}"><h4>Data Resources BD</h4></a>
    </div>

    <ul class="list-unstyled components">
        <li class="{{ request()->url() == route('news.for.you') ? 'sidebar-active' : '' }}">
            <a href="{{route('news.for.you')}}">News For You</a>
        </li>

        @if(Auth::user()->type == 'visitor' || Auth::user()->type == 'paid')
            <li class="{{ request()->url() == route('invoice.user') ? 'sidebar-active' : '' }}">
                <a href="{{route('invoice.user')}}">Invoice</a>
            </li>
            <li class="{{ request()->url() == route('invoice.getuser') ? 'sidebar-active' : '' }}">
                <a href="{{route('invoice.getuser')}}">Subscriber</a>
            </li>
            <li class="{{ request()->url() == route('purchased.item') ? 'sidebar-active' : '' }}">
                <a href="{{route('purchased.item')}}">Purchased List</a>
            </li>

            @if(Auth::user()->type == 'paid')
                <li class="{{ request()->url() == route('user.index') ? 'sidebar-active' : '' }}">
                    <a href="{{route('user.index')}}">Users</a>
                </li>
            @endif
        @elseif(Auth::user()->type == 'provider')
            <li class="{{ request()->url() == route('invoice.user') ? 'sidebar-active' : '' }}">
                <a href="{{route('invoice.user')}}">Invoice</a>
            </li>
            <li class="{{ request()->url() == route('invoice.getuser') ? 'sidebar-active' : '' }}">
                <a href="{{route('invoice.getuser')}}">Subscriber</a>
            </li>
            <li class="{{ request()->url() == route('research') ? 'sidebar-active' : '' }}">
                <a href="{{route('research')}}">Research List</a>
            </li>
            <li class="{{ request()->url() == route('purchased.item') ? 'sidebar-active' : '' }}">
                <a href="{{route('purchased.item')}}">Purchased List</a>
            </li>
        @else
            <li class="{{ request()->url() == route('menu.index') ? 'sidebar-active' : '' }}">
                <a href="{{route('menu.index')}}">Menu</a>
            </li>
            <li class="{{ request()->url() == route('page.index') ? 'sidebar-active' : '' }}">
                <a href="{{route('page.index')}}">Page</a>
            </li>
            <li class="{{ request()->url() == route('sector.index') ? 'sidebar-active' : '' }}">
                <a href="{{route('sector.index')}}">Sector</a>
            </li>
            <li class="{{ request()->url() == route('admin.research') ? 'sidebar-active' : '' }}">
                <a href="{{route('admin.research')}}">Research list</a>
            </li>
            <li class="{{ request()->url() == route('admin.research.category') ? 'sidebar-active' : '' }}">
                <a href="{{route('admin.research.category')}}">Research Category</a>
            </li>
            <li class="{{ request()->url() == route('company.index') ? 'sidebar-active' : '' }}">
                <a href="{{route('company.index')}}">Company</a>
            </li>
            <li class="{{ request()->url() == route('announcment.index') ? 'sidebar-active' : '' }}">
                <a href="{{route('announcment.index')}}">Announcment</a>
            </li>
            <li class="{{ request()->url() == route('subscriptionplan.index') ? 'sidebar-active' : '' }}">
                <a href="{{route('subscriptionplan.index')}}">Subscription Plan</a>
            </li>
            <li class="{{ request()->url() == route('survey.index') ? 'sidebar-active' : '' }}">
                <a href="{{route('survey.index')}}">Survey</a>
            </li>
            <li class="{{ request()->url() == route('news.portal') ? 'sidebar-active' : '' }}">
                <a href="{{route('news.portal')}}">News</a>
            </li>
            <li class="{{ request()->url() == route('newspapers') ? 'sidebar-active' : '' }}">
                <a href="{{route('newspapers')}}">Newspaper</a>
            </li>
            <li class="{{ request()->url() == route('topnews.index') ? 'sidebar-active' : '' }}">
                <a href="{{route('topnews.index')}}">Top News</a>
            </li>
            <li class="{{ request()->url() == route('nl_category.index') ? 'sidebar-active' : '' }}">
                <a href="{{route('nl_category.index')}}">Newsletter Category</a>
            </li>
            <li class="{{ request()->url() == route('newsletter.index') ? 'sidebar-active' : '' }}">
                <a href="{{route('newsletter.index')}}">Newsletter</a>
            </li>
            {{-- <li class="{{ request()->url() == route('surveyquestion.index') ? 'sidebar-active' : '' }}">
                <a href="{{route('surveyquestion.index')}}">Survey Question</a>
            </li> --}}
            {{-- <li class="{{ request()->url() == route('configuration.index') ? 'sidebar-active' : '' }}">
                <a href="{{route('configuration.index')}}">Configuration</a>
            </li> --}}
            {{-- <li class="{{ request()->url() == route('surveyansweroption.index') ? 'sidebar-active' : '' }}">
                <a href="{{route('surveyansweroption.index')}}">Survey Answer Option</a>
            </li> --}}
            <li class="{{ request()->url() == route('user.index') ? 'sidebar-active' : '' }}">
                <a href="{{route('user.index')}}">User</a>
            </li>
            {{-- <li class="{{ request()->url() == route('stockinfo.index') ? 'sidebar-active' : '' }}">
                <a href="{{route('stockinfo.index')}}">Stock Info</a>
            </li> --}}
            <li class="{{ request()->url() == route('invoice.index') ? 'sidebar-active' : '' }}">
                <a href="{{route('invoice.index')}}">Invoice</a>
            </li>
            <li class="{{ request()->url() == route('stockinfo.data-matrix') ? 'sidebar-active' : '' }}">
                <a href="{{route('stockinfo.data-matrix')}}">Data Matrix</a>
            </li>
            <li class="{{ request()->url() == route('recent.index') ? 'sidebar-active' : '' }}">
                <a href="{{route('recent.index')}}">Most Recent</a>
            </li>
            <li class="{{ request()->url() == route('offline.payments') ? 'sidebar-active' : '' }}">
                <a href="{{route('offline.payments')}}">Offline Payments</a>
            </li>
            <li class="{{ request()->url() == route('tutorial.index') ? 'sidebar-active' : '' }}">
                <a href="{{route('tutorial.index')}}">Trainings</a>
            </li>
            {{-- <li >
                <a href="#">About</a>
            </li>
            <li>
                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Pages</a>
                <ul class="collapse list-unstyled" id="pageSubmenu">
                    <li>
                        <a href="#">Page 1</a>
                    </li>
                    <li>
                        <a href="#">Page 2</a>
                    </li>
                    <li>
                        <a href="#">Page 3</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">Portfolio</a>
            </li>
            <li>
                <a href="#">Contact</a>
            </li> --}}
        @endif
    </ul>
</nav>
