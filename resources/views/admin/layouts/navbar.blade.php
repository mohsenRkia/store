<div class="main-navbar sticky-top bg-white">
    <!-- Main Navbar -->
    <nav class="navbar align-items-stretch navbar-light flex-md-nowrap p-0">
        <ul class="navbar-nav border-left flex-row ">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-nowrap px-3" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">

                    @if($userInfo->image)
                    <img class="user-avatar rounded-circle mr-2" src="/uploads/images/avatars/{{$userInfo->image->url}}" alt="User Avatar">
                    @else
                    <img class="user-avatar rounded-circle mr-2" src="/avatar.png" alt="User Avatar" width="110">
                    @endif
                    <span class="d-none d-md-inline-block">{{Auth::user()->name}}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-small">
                    <a class="dropdown-item" href="{{route('profile.index',['id' => Auth::user()])}}">
                        <i class="material-icons">&#xE7FD;</i> Profile</a>
                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
                        <i class="material-icons text-danger">&#xE879;</i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
        <nav class="nav">
            <a href="#" class="nav-link nav-link-icon toggle-sidebar d-md-inline d-lg-none text-center border-left" data-toggle="collapse" data-target=".header-navbar" aria-expanded="false" aria-controls="header-navbar">
                <i class="material-icons">&#xE5D2;</i>
            </a>
        </nav>
    </nav>
</div>
            