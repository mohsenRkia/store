@extends('site.layouts.layout')



@section('content')
<div id="app">
    <aside id="colorlib-hero" class="breadcrumbs">
        <div class="flexslider">
            <ul class="slides">
                <li style="background-image: url(images/cover-img-1.jpg);">
                    <div class="overlay"></div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3 col-sm-12 col-xs-12 slider-text">
                                <div class="slider-text-inner text-center">
                                    <h1>Shopping Cart</h1>
                                    <h2 class="bread"><span><a href="index.html">Home</a></span> <span><a href="shop.html">Product</a></span> <span>Shopping Cart</span></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </aside>

    <div class="colorlib-shop">
        <div class="container">
            <div class="row row-pb-md">
                <div class="col-md-10 col-md-offset-1">
                    <div class="process-wrap">
                        <div class="process text-center active">
                            <p><span>01</span></p>
                            <h3>Shopping Cart</h3>
                        </div>
                        <div class="process text-center">
                            <p><span>02</span></p>
                            <h3>Checkout</h3>
                        </div>
                        <div class="process text-center">
                            <p><span>03</span></p>
                            <h3>Order Complete</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row row-pb-md">
                <div class="col-md-10 col-md-offset-1">
                    <div class="product-name">
                        <div class="one-forth text-center">
                            <span>Product Details</span>
                        </div>
                        <div class="one-eight text-center">
                            <span>Price</span>
                        </div>
                        <div class="one-eight text-center">
                            <span>Quantity</span>
                        </div>
                        <div class="one-eight text-center">
                            <span>Total</span>
                        </div>
                        <div class="one-eight text-center">
                            <span>Remove</span>
                        </div>
                    </div>

                    @foreach($baskets as $basket)
                    <div class="product-cart">
                        <div class="one-forth">
                            @foreach($basket->product->images as $key => $productimage)
                                @if($key == 0 )
                            <div class="product-img" style="background-image: url('/uploads/images/products/{{$productimage->url}}');">
                            </div>
                                @endif
                            @endforeach
                            <div class="display-tc">
                                <a href="{{route('site.product.show',['id' =>$basket->product->id , 'slug' => $basket->product->slug])}}">
                                <h3>{{$basket->product->name}}</h3>
                                </a>
                            </div>
                        </div>
                        <div class="one-eight text-center">
                            <div class="display-tc">
                                <span class="price">${{$basket->originalprice}}</span>
                            </div>
                        </div>
                        <div class="one-eight text-center">
                            <div class="display-tc">
                                {{$basket->productqty}}
                            </div>
                        </div>
                        <div class="one-eight text-center">
                            <div class="display-tc">
                                <span class="price">${{$basket->totalprice}}</span>
                            </div>
                        </div>
                        <div class="one-eight text-center">
                            <div class="display-tc">
                                <button @click="deleteBasket({{$basket->id}},'Item')" class="btn btn-danger">Delete</button>
                            </div>
                        </div>
                    </div>
                    @endforeach


                </div>
            </div>
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="total-wrap">
                        <div class="row">
                            <div class="col-md-8">
                                <form action="{{route('site.cart.check')}}" method="POST">
                                    @csrf
                                    <div class="row form-group">
                                        <div class="col-md-9">
                                            <input type="text" name="discount" class="form-control input-number" placeholder="Your Coupon Number...">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="submit" value="Apply" class="btn btn-success">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-3 col-md-push-1 text-center">
                                <div class="total">
                                    <div class="grand-total">
                                        <p><span><strong>Total:</strong></span> <span>${{$totalPriceItem}}</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="colorlib-shop">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 text-center colorlib-heading">
                    <h2><span>Recommended Products</span></h2>
                    <p>We love to tell our successful far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 text-center">
                    <div class="product-entry">
                        <div class="product-img" style="background-image: url(images/item-5.jpg);">
                            <p class="tag"><span class="new">New</span></p>
                            <div class="cart">
                                <p>
                                    <span class="addtocart"><a href="#"><i class="icon-shopping-cart"></i></a></span>
                                    <span><a href="product-detail.html"><i class="icon-eye"></i></a></span>
                                    <span><a href="#"><i class="icon-heart3"></i></a></span>
                                    <span><a href="add-to-wishlist.html"><i class="icon-bar-chart"></i></a></span>
                                </p>
                            </div>
                        </div>
                        <div class="desc">
                            <h3><a href="shop.html">Floral Dress</a></h3>
                            <p class="price"><span>$300.00</span></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 text-center">
                    <div class="product-entry">
                        <div class="product-img" style="background-image: url(images/item-6.jpg);">
                            <p class="tag"><span class="new">New</span></p>
                            <div class="cart">
                                <p>
                                    <span class="addtocart"><a href="#"><i class="icon-shopping-cart"></i></a></span>
                                    <span><a href="product-detail.html"><i class="icon-eye"></i></a></span>
                                    <span><a href="#"><i class="icon-heart3"></i></a></span>
                                    <span><a href="add-to-wishlist.html"><i class="icon-bar-chart"></i></a></span>
                                </p>
                            </div>
                        </div>
                        <div class="desc">
                            <h3><a href="shop.html">Floral Dress</a></h3>
                            <p class="price"><span>$300.00</span></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 text-center">
                    <div class="product-entry">
                        <div class="product-img" style="background-image: url(images/item-7.jpg);">
                            <p class="tag"><span class="new">New</span></p>
                            <div class="cart">
                                <p>
                                    <span class="addtocart"><a href="#"><i class="icon-shopping-cart"></i></a></span>
                                    <span><a href="product-detail.html"><i class="icon-eye"></i></a></span>
                                    <span><a href="#"><i class="icon-heart3"></i></a></span>
                                    <span><a href="add-to-wishlist.html"><i class="icon-bar-chart"></i></a></span>
                                </p>
                            </div>
                        </div>
                        <div class="desc">
                            <h3><a href="shop.html">Floral Dress</a></h3>
                            <p class="price"><span>$300.00</span></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 text-center">
                    <div class="product-entry">
                        <div class="product-img" style="background-image: url(images/item-8.jpg);">
                            <p class="tag"><span class="new">New</span></p>
                            <div class="cart">
                                <p>
                                    <span class="addtocart"><a href="#"><i class="icon-shopping-cart"></i></a></span>
                                    <span><a href="product-detail.html"><i class="icon-eye"></i></a></span>
                                    <span><a href="#"><i class="icon-heart3"></i></a></span>
                                    <span><a href="add-to-wishlist.html"><i class="icon-bar-chart"></i></a></span>
                                </p>
                            </div>
                        </div>
                        <div class="desc">
                            <h3><a href="shop.html">Floral Dress</a></h3>
                            <p class="price"><span>$300.00</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>
@endsection