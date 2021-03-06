
<aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0">
    <div class="main-navbar">
        <nav class="navbar align-items-stretch navbar-light bg-white flex-md-nowrap border-bottom p-0">
            <a class="navbar-brand w-100 mr-0" href="#" style="line-height: 25px;">
                <div class="d-table m-auto">
                    <img id="main-logo" class="d-inline-block align-top mr-1" style="max-width: 25px;" src="/admin/images/shards-dashboards-logo.svg" alt="Shards Dashboard">
                    <span class="d-none d-md-inline ml-1">Shards Dashboard</span>
                </div>
            </a>
            <a class="toggle-sidebar d-sm-inline d-md-none d-lg-none">
                <i class="material-icons">&#xE5C4;</i>
            </a>
        </nav>
    </div>
    <form action="#" class="main-sidebar__search w-100 border-right d-sm-flex d-md-none d-lg-none">
        <div class="input-group input-group-seamless ml-3">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="fas fa-igloo"></i>
                </div>
            </div>
            <input class="navbar-search form-control" type="text" placeholder="Search for something..." aria-label="Search"> </div>
    </form>
    <div class="nav-wrapper">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="{{route('admin.index')}}">
                    <i class="material-icons">edit</i>
                    <span>Blog Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('menu.index')}}">
                    <i class="material-icons">edit</i>
                    <span>Menu</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('category.index')}}">
                    <i class="material-icons">edit</i>
                    <span>Categories</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('slider.index')}}">
                    <i class="material-icons">edit</i>
                    <span>Sliders</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('offeritem.index')}}">
                    <i class="material-icons">edit</i>
                    <span>Offer Items</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('special.create')}}">
                    <i class="material-icons">edit</i>
                    <span>Special Offer</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('state.list')}}">
                    <i class="material-icons">edit</i>
                    <span>Location</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('level.index')}}">
                    <i class="material-icons">edit</i>
                    <span>Levels</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('cart.index')}}">
                    <i class="material-icons">edit</i>
                    <span>Carts</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.satisfied.index')}}">
                    <i class="material-icons">edit</i>
                    <span>Satisfied</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('profile.index',['id' => Auth::user()->id])}}">
                    <i class="material-icons">person</i>
                    <span>Profile</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.users.list')}}">
                    <i class="material-icons">edit</i>
                    <span>Users</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="index.html">
                    <i class="material-icons">edit</i>
                    <span>My Orders</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{route('admin.blog.index')}}">
                    <i class="material-icons">vertical_split</i>
                    <span>Blog Posts</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{route('product.index')}}">
                    <i class="material-icons">vertical_split</i>
                    <span>Products List</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{route('product.create')}}">
                    <i class="material-icons">note_add</i>
                    <span>Add New Product</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.about.create')}}">
                    <i class="material-icons">table_chart</i>
                    <span>About</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.contactus.index')}}">
                    <i class="material-icons">table_chart</i>
                    <span>Contact Us</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.setting.index')}}">
                    <i class="material-icons">table_chart</i>
                    <span>Settings</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
        