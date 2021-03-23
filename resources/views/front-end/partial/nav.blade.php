<style>
    .navbar-nav {
        display: -webkit-box;
    }
</style>
<nav class="navbar navbar-expand-lg navbar-dark bg-light fixed-top nav-bg border-bottom mt-lg-n5">
    <div class="container">
        <a class="navbar-brand text-white" href="/"><h2>DRB</h2></a>
        {{-- @if (!Request::is('/')) --}}
        <div class="search-custom-margin">
            <form action="{{route('search')}}" method="GET">
                <div class="input-group">
                    <input class="form-control border-secondary border border-secondary search-width" type="search" value="" name="search" placeholder="search for Company, Industry &amp News">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-warning border border-secondary search-btn-width" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
            <form class="form-inline auth-nav-btn">
                @if(Auth::check())
                    <a class="text-white small mr-3" href="{{route('logout')}}">Sign Out</a>
                @else
                    <a class="text-white small mr-3" href="{{route('login')}}">Sign In</a>
                @endif
            </form>
        </div>
        {{-- @endif --}}
        <button class="navbar-toggler custom-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto mr-auto">
                <li class="nav-item nav-custom-margin-top">
                    <a class="nav-link font-weight-bold text-white" href="{{route('news.index')}}" >
                        <small class="font-weight-bold nav-item-custom-size">NEWS</small>
                    </a>
                </li>

                <li class="nav-item nav-custom-margin-top">
                    <a class="nav-link font-weight-bold text-white" href="{{ route('newsletters.index') }}" >
                        <small class="font-weight-bold nav-item-custom-size">Newsletter</small>
                    </a>
                </li>


                {{-- <li class="nav-item dropdown nav-custom-margin-top">
                    <a class="nav-link font-weight-bold text-white" href="{{route('visualize.index')}}">
                        <small class="font-weight-bold nav-item-custom-size">CHART</small>
                    </a>
                </li> --}}
                {{--<li class="nav-item dropdown nav-custom-margin-top">--}}
                    {{--<a class="nav-link font-weight-bold text-white" href="{{route('visualize.data-matrix')}}">--}}
                        {{--<small class="font-weight-bold nav-item-custom-size">DASHBOARD</small>--}}
                    {{--</a>--}}
                {{--</li>--}}

                @php
                    $menus = App\Menu::whereNull('parent_menu_id')->orderBy('created_at', 'DESC')->get();
                @endphp
                @foreach($menus as $menu)
                    @php
                        $sub_menus = App\Menu::where('parent_menu_id', $menu->id)->orderBy('created_at', 'DESC')->get();
                    @endphp
                    @if(count($sub_menus)>0)
                    <li class="nav-item dropdown nav-custom-margin-top">
                        <a class="nav-link dropdown-toggle font-weight-bold text-white" href="{{ $menu->page ? route('page', $menu->page->slug) : "#" }}"  id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <small class="font-weight-bold nav-item-custom-size">{{$menu->title}}</small>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li>
                                <a class="dropdown-item font-weight-bold" style="background: transparent;" href="{{route('finance-info-all')}}">
                                    <small class="font-weight-bold nav-item-custom-size text-uppercase">Financial Statement</small>
                                </a>
                            </li>

                            @foreach($sub_menus as $menu)
                                <li>
                                    <a class="dropdown-item" href="{{ $menu->page ? route('page', $menu->page->slug) : "#" }}">
                                        <small class="font-weight-bold nav-item-custom-size">{{$menu->title}}</small>
                                    </a>

                                    @php
                                        $sub_submenus = App\Menu::where('parent_menu_id', $menu->id)->orderBy('created_at', 'DESC')->get();
                                    @endphp
                                    @if(count($sub_submenus)>0)
                                        <ul class="submenu dropdown-menu">

                                                @foreach($sub_submenus as $menu)
                                                    <li><a class="dropdown-item" href="{{ $menu->page ? route('page', $menu->page->slug) : "#" }}">
                                                            <small class="font-weight-bold nav-item-custom-size">{{$menu->title}}</small>
                                                        </a>
                                                    </li>
                                                @endforeach

                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    @else
                        @if($menu->title == "RESEARCHEX")
                            <li class="nav-item nav-custom-margin-top">
                                <a class="nav-link font-weight-bold text-white" href="{{ route('research.list') }}" >
                                    <small class="font-weight-bold nav-item-custom-size">{{$menu->title}}</small>
                                </a>
                            </li>
                        @elseif($menu->title == "PRICING")
                            {{--<li class="nav-item nav-custom-margin-top">--}}
                                {{--<a class="nav-link font-weight-bold text-white" href="{{ route('pricing') }}" >--}}
                                    {{--<small class="font-weight-bold nav-item-custom-size">{{$menu->title}}</small>--}}
                                {{--</a>--}}
                            {{--</li>--}}
                        @else
                            <li class="nav-item nav-custom-margin-top">
                                <a class="nav-link font-weight-bold text-white" href="{{ $menu->page ? route('page',  $menu->page->slug) : "#" }}" >
                                    <small class="font-weight-bold nav-item-custom-size">{{$menu->title}}</small>
                                </a>
                            </li>
                        @endif
                    @endif
                @endforeach
                @foreach($menus as $menu)
                    @if($menu->title == "PRICING")
                        <li class="nav-item nav-custom-margin-top">
                            <a class="nav-link font-weight-bold text-white" href="{{ route('pricing') }}" >
                                <small class="font-weight-bold nav-item-custom-size">{{$menu->title}}</small>
                            </a>
                        </li>
                    @endif
                @endforeach

                {{--<li class="nav-item nav-custom-margin-top">--}}
                    {{--<a class="nav-link font-weight-bold text-white" href="{{ route('tutorials.view.index') }}" >--}}
                        {{--<small class="font-weight-bold nav-item-custom-size">TRAINING</small>--}}
                    {{--</a>--}}
                {{--</li>--}}



                <li class="signin-buttons form-inline my-2 my-lg-0">
                    <div class="signin-buttons-positioning">

                        <a href="{{route('cart')}}" class="shopping-cart">
                            <div id="ex4">
                          <span class="p1 fa-stack fa-2x has-badge" data-count="{{ App\Cart::getCartCount() }}">
                            <i class="p3 fa fa-shopping-cart fa-stack-1x xfa-inverse" data-count="4b"></i>
                          </span>
                            </div>
                        </a>
                        @if(Auth::check())
                            @if(Auth::user()->type == 'admin')
                                <a class="btn btn-warning btn-sm my-2 my-sm-0 mx-1" href="/admin/menu">Admin Panel</a>
                            @else
                                <a class="btn btn-warning btn-sm my-2 my-sm-0 mx-1" href="/invoice-user">Admin Panel</a>
                            @endif
                            <a class="btn btn-warning btn-sm my-2 my-sm-0 mx-1" href="{{route('logout')}}">Sign Out</a>
                        @else
                            <a class="btn btn-warning btn-sm my-2 my-sm-0 mx-1" href="{{route('register')}}">Sign Up</a>
                            <a class="btn btn-outline-warning btn-sm my-2 my-sm-0 text-white mx-1" href="{{route('login')}}">Sign In</a>
                        @endif
                    </div>
                </li>
            </ul>
        </div>
    </div>

    @if (Request::is('/'))
        @if(App\Announcment::where('is_published', true)->first())
            <div class="alert alert-info border-0 announcement" role="alert">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>Announcement! </strong>{{ App\Announcment::where('is_published', true)->first()->text }}</<strong>
            </div>
        @endif
    @endif
</nav>
