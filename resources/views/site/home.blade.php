@extends('site.layouts.layout')



@section('content')


    <aside id="colorlib-hero">
        <div class="flexslider">
            <ul class="slides">
                @foreach($sliders as $slider)
                    @if($slider->location == "L")
                <li style="background-image: url('/uploads/images/slider/{{$slider->urlimage}}');">
                    <div class="overlay"></div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3 col-md-pull-2 col-sm-12 col-xs-12 slider-text">
                                <div class="slider-text-inner">
                                    <div class="desc">
                                        <h1 class="head-1">{{$slider->bigtitle}}</h1>
                                        <h2 class="head-2">{{$slider->smalltitle}}</h2>
                                        <h2 class="head-3">{{$slider->reason}}</h2>
                                        <p class="category"><span>{{$slider->description}}</span></p>
                                        <p><a href="{{$slider->link}}" class="btn btn-primary">Shop Collection</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                    @else
                <li style="background-image: url('/uploads/images/slider/{{$slider->urlimage}}');">
                    <div class="overlay"></div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3 col-md-push-3 col-sm-12 col-xs-12 slider-text">
                                <div class="slider-text-inner">
                                    <div class="desc">
                                        <h1 class="head-1">{{$slider->bigtitle}}</h1>
                                        <h2 class="head-2">{{$slider->smalltitle}}</h2>
                                        <h2 class="head-3">{{$slider->reason}}</h2>
                                        <p class="category"><span>{{$slider->description}}</span></p>
                                        <p><a href="{{$slider->link}}" class="btn btn-primary">Shop Collection</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </aside>


    <div id="colorlib-featured-product">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    @foreach($offers as $offer)
                        @if($offer->location == "L")
                    <a href="{{$offer->link}}" class="f-product-1" style="background-image: url('/uploads/images/offers/{{$offer->imageurl}}');">
                        <div class="desc">
                            <h2><br>{{$offer->title}}<br></h2>
                        </div>
                    </a>
                        @endif
                    @endforeach
                </div>
                <div class="col-md-6">
                    <div class="row">
                        @foreach($offers as $offer)
                        @if($offer->location == "SL")
                        <div class="col-md-6">
                            <a href="{{$offer->link}}" class="f-product-2" style="background-image: url('/uploads/images/offers/{{$offer->imageurl}}');">
                                <div class="desc">
                                    <h2><br>{{$offer->title}}<br></h2>
                                </div>
                            </a>
                        </div>
                        @elseif($offer->location == "SR")
                        <div class="col-md-6">
                            <a href="{{$offer->link}}" class="f-product-2" style="background-image: url('/uploads/images/offers/{{$offer->imageurl}}');">
                                <div class="desc">
                                    <h2><br>{{$offer->title}}<br></h2>
                                </div>
                            </a>
                        </div>
                            @endif
                        @endforeach
                        <div class="col-md-12">
                            @foreach($offers as $offer)
                                @if($offer->location == "M")
                            <a href="{{$offer->link}}" class="f-product-2" style="background-image: url('/uploads/images/offers/{{$offer->imageurl}}');">
                                <div class="desc">
                                    <h2><br>{{$offer->title}}<br></h2>
                                </div>
                            </a>
                                @endif
                            @endforeach
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
                    <h2><span>New Arrival</span></h2>
                    <p>We love to tell our successful far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                </div>
            </div>
            <div class="row">
                @foreach($products as $product)
                <div class="col-md-3 text-center">
                    <div class="product-entry">
                        @foreach($product->images as $key => $image)
                            @if($key == 0)
                        <div class="product-img" style="background-image: url('/uploads/images/products/{{$image->url}}');">
                            <p class="tag"><span class="new">New</span></p>
                            <div class="cart">
                                <p>
                                    <span class="addtocart"><a href="{{route('site.product.show',['id'=> $product->id,'slug'=>$product->slug])}}"><i class="icon-shopping-cart"></i></a></span>
                                    <span><a href="{{route('site.product.show',['id'=> $product->id,'slug'=>$product->slug])}}"><i class="icon-eye"></i></a></span>
                                    <span><a href="#"><i class="icon-heart3"></i></a></span>
                                    <span><a href="add-to-wishlist.html"><i class="icon-bar-chart"></i></a></span>
                                </p>
                            </div>
                        </div>
                            @endif
                        @endforeach
                        <div class="desc">
                            <h3><a href="shop.html">{{$product->name}}</a></h3>
                            <p class="price"><span>$300.00</span></p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div id="colorlib-intro" class="colorlib-intro" style="background-image: url(/site/images/cover-img-1.jpg);" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="intro-desc">
                        <div class="text-salebox">
                            <div class="text-lefts">
                                <div class="sale-box">
                                    <div class="sale-box-top">
                                        <h2 class="number">{{$special->discountvalue}}</h2>
                                        <span class="sup-1">%</span>
                                        <span class="sup-2">Off</span>
                                    </div>
                                    <h2 class="text-sale">Sale</h2>
                                </div>
                            </div>
                            <div class="text-rights">
                                <h3 class="title">{{$special->title}}</h3>
                                <p>{{$special->description}}</p>
                                <p><a href="{{$special->link}}" class="btn btn-primary">Shop Now</a>
                                    <a href="{{$special->link}}" class="btn btn-primary btn-outline">Read more</a></p>
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
                    <h2><span>Top Products</span></h2>
                    <p>8 Top Products which have been sold recently.</p>
                </div>
            </div>
            <div class="row">
                @foreach($carts as $cart)
                <div class="col-md-3 text-center">
                    <div class="product-entry">
                        @foreach($cart->product->images as $key => $image)
                            @if($key == 0)
                        <div class="product-img" style="background-image: url('/uploads/images/products/{{$image->url}}');">
                            @endif
                            @endforeach
                            <p class="tag"><span class="sale">{{$cart->total}} Sold</span></p>
                            <div class="cart">
                                <p>
                                    <span class="addtocart"><a href="{{route('site.product.show',['id'=> $cart->product->id,'slug'=>$cart->product->slug])}}"><i class="icon-shopping-cart"></i></a></span>
                                    <span><a href="{{route('site.product.show',['id'=> $cart->product->id,'slug'=>$cart->product->slug])}}"><i class="icon-eye"></i></a></span>
                                    <span><a href="#"><i class="icon-heart3"></i></a></span>
                                    <span><a href="add-to-wishlist.html"><i class="icon-bar-chart"></i></a></span>
                                </p>
                            </div>
                        </div>
                        <div class="desc">
                            <h3><a href="{{route('site.product.show',['id'=> $cart->product->id,'slug'=>$cart->product->slug])}}">{{$cart->product->name}}</a></h3>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div id="colorlib-testimony" class="colorlib-light-grey">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 text-center colorlib-heading">
                    <h2><span>Our Satisfied Customer says</span></h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="owl-carousel2">
                        @foreach($satisfiedComments as $cm)
                        <div class="item">
                            <div class="testimony text-center">
                                @if($cm->user->image)
                                    <span class="img-user" style="background-image: url('/uploads/images/avatars/{{$cm->user->image->url}}');"></span>
                                @else
                                    <span class="img-user" style="background-image: url('/avatar.png');"></span>
                                @endif

                                <span class="user">{{$cm->user->name}}</span>
                                    @if(!$cm->user->profile->state == null)
                                <small>{{$cm->user->profile->state->name}}, {{$cm->user->profile->state->country->name}}</small>
                                @endif
                                        <blockquote>
                                    <p>"{{$cm->body}}"</p>
                                </blockquote>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="colorlib-blog">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center colorlib-heading">
                    <h2>Recent Blog</h2>
                    <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <article class="article-entry">
                        <a href="blog.html" class="blog-img" style="background-image: url(/site/images/blog-1.jpg);"></a>
                        <div class="desc">
                            <p class="meta"><span class="day">02</span><span class="month">Mar</span></p>
                            <p class="admin"><span>Posted by:</span> <span>Noah Henderson</span></p>
                            <h2><a href="blog.html">Openning Branches</a></h2>
                            <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life</p>
                        </div>
                    </article>
                </div>
                <div class="col-md-4">
                    <article class="article-entry">
                        <a href="blog.html" class="blog-img" style="background-image: url(/site/images/blog-2.jpg);"></a>
                        <div class="desc">
                            <p class="meta"><span class="day">02</span><span class="month">Mar</span></p>
                            <p class="admin"><span>Posted by:</span> <span>Noah Henderson</span></p>
                            <h2><a href="blog.html">Openning Branches</a></h2>
                            <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life</p>
                        </div>
                    </article>
                </div>
                <div class="col-md-4">
                    <article class="article-entry">
                        <a href="blog.html" class="blog-img" style="background-image: url(/site/images/blog-3.jpg);"></a>
                        <div class="desc">
                            <p class="meta"><span class="day">02</span><span class="month">Mar</span></p>
                            <p class="admin"><span>Posted by:</span> <span>Noah Henderson</span></p>
                            <h2><a href="blog.html">Openning Branches</a></h2>
                            <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life</p>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>


@endsection