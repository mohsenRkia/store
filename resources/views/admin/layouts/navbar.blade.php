
<div class="main-navbar sticky-top bg-white">
    <!-- Main Navbar -->
    <nav class="navbar align-items-stretch navbar-light flex-md-nowrap p-0">
        <ul class="navbar-nav border-left flex-row ">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-nowrap px-3" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <img class="user-avatar rounded-circle mr-2" src="/admin/images/avatars/0.jpg" alt="User Avatar">
                    <span class="d-none d-md-inline-block">Sierra Brooks</span>
                </a>
                <div class="dropdown-menu dropdown-menu-small">
                    <a class="dropdown-item" href="user-profile-lite.html">
                        <i class="material-icons">&#xE7FD;</i> Profile</a>
                    <a class="dropdown-item" href="components-blog-posts.html">
                        <i class="material-icons">vertical_split</i> Blog Posts</a>
                    <a class="dropdown-item" href="add-new-post.html">
                        <i class="material-icons">note_add</i> Add New Post</a>
                    <div class="dropdown-divider"></div>
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
            