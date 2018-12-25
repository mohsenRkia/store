<nav class="colorlib-nav" role="navigation">
    <div class="top-menu">
        <div class="container">
            <div class="row">
                <div class="col-xs-2">
                    <div id="colorlib-logo"><a href="index.html">Store</a></div>
                </div>
                <div class="col-xs-10 text-right menu-1">
                    <ul>
                        <li class="active"><a href="index.html">Home</a></li>
                        <li class="has-dropdown">
                            <a href="shop.html">Shop</a>
                            <ul class="dropdown">
                                <li><a href="product-detail.html">Product Detail</a></li>
                                <li><a href="cart.html">Shipping Cart</a></li>
                                <li><a href="checkout.html">Checkout</a></li>
                                <li><a href="order-complete.html">Order Complete</a></li>
                                <li><a href="add-to-wishlist.html">Wishlist</a></li>
                            </ul>
                        </li>
                        @foreach($menus as $menu)
                            <li><a href="{{$menu->link}}">{{$menu->name}}</a></li>
                        @endforeach



                        <li><a href="cart.html"><i class="icon-shopping-cart"></i> Cart [0]</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
