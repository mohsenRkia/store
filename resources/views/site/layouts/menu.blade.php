<nav class="colorlib-nav" role="navigation">
    <div class="top-menu">
        <div class="container">
            <div class="row">
                <div class="col-xs-2">
                    <div id="colorlib-logo"><a href="index.html">Store</a></div>
                </div>
                <div class="col-xs-10 text-right menu-1">
                    <ul>
                        <li class="active"><a href="{{route('home.index')}}">Home</a></li>

                        @foreach($collection as $key => $category)
                            <li class="has-dropdown"><a href="{{route('home.index')}}/category/{{strtolower($key)}}">{{$key}}</a>
                                <ul class="dropdown">
                                    @foreach($category as $colections)
                                        @foreach($colections as $subCat)
                                    <li><a href="{{route('home.index')}}/category/{{strtolower($key)}}/{{strtolower($subCat->name)}}">{{$subCat->name}}</a></li>
                                        @endforeach
                                        @endforeach
                                </ul>
                            </li>
                        @endforeach
                        @foreach($menus as $menu)
                            <li><a href="{{$menu->link}}">{{$menu->name}}</a></li>
                        @endforeach
                        @if(Auth::user())
                            <li>
                                <a href="{{route('user.index')}}">
                                    Panel
                                </a>
                            </li>
                        <li>
                            <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
                                 Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                        @else
                        <li>
                            <a href="{{route('register')}}">
                                Register
                            </a>
                        </li>
                            <li>
                                <a href="{{route('login')}}">
                                    Login
                                </a>
                            </li>
                        @endif


                        <li><a href="{{route('site.cart')}}"><i class="icon-shopping-cart"></i>
                                Cart [
                            @if(is_null($cartCount))
                                0
                                @else
                                {{$cartCount}}
                                @endif
                                ]
                            </a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
