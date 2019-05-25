@extends('site.layouts.layout')



@section('content')
    <div id="app">
        <aside id="colorlib-hero" class="breadcrumbs">
            <div class="flexslider">
                <ul class="slides">
                    <li style="background-image: url('/site/images/cover-img-1.jpg');">
                        <div class="overlay"></div>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6 col-md-offset-3 col-sm-12 col-xs-12 slider-text">
                                    <div class="slider-text-inner text-center">
                                        <h1>Product Detail</h1>
                                        <h2 class="bread"><span><a href="{{route('home.index')}}">Home</a></span> <span><a href="shop.html">Product</a></span> <span>Product Detail</span></h2>
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
                @if($errors->any())
                    <ul style="list-style: none">
                        @foreach($errors->all() as $error)
                            <li class="alert-danger">
                                {{$error}}
                            </li>
                        @endforeach
                    </ul>
                @endif
                <div class="row row-pb-lg">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="product-detail-wrap">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="product-entry">
                                        @foreach($product->images as $key => $image)
                                            @if($key == 0)
                                                <div class="product-img" style="background-image: url('/uploads/images/products/{{$image->url}}');">
                                                    <p class="tag"><span class="sale">Sale</span></p>
                                                </div>
                                            @endif
                                        @endforeach
                                        <div class="thumb-nail">
                                            @foreach($product->images as $key => $image)
                                                @if(!$key == 0 && $key <= 3)
                                                    <a href="#" class="thumb-img" style="background-image: url('/uploads/images/products/{{$image->url}}');"></a>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="desc">
                                        <h3>{{$product->name}}</h3>
                                        <p class="price">
                                        @if($product->offerprice > 0)
                                            @foreach($product->prices as $originalprice)
                                                <div class="text-sale" style="font-size: 12px;font-weight: bold;"><del>${{$originalprice->originalprice}}</del></div>
                                            @endforeach
                                            <div class="text-danger" style="font-size: 18px;font-weight: bold;">${{$product->offerprice}}</div>
                                        @else
                                            @foreach($product->prices as $originalprice)
                                                ${{$originalprice->originalprice}}
                                            @endforeach
                                        @endif
                                        <span class="rate text-right">
												<i class="icon-star-full"></i>
												<i class="icon-star-full"></i>
												<i class="icon-star-full"></i>
												<i class="icon-star-full"></i>
												<i class="icon-star-half"></i>
												(74 Rating)
											</span>
                                        </p>
                                        <p>
                                            {{$product->description}}
                                        </p>
                                        <form action="{{route('site.product.addtobasket',['id' => $product->id])}}" method="POST">
                                            @csrf
                                            <div class="color-wrap">
                                                <p class="color-desc">
                                                    Color:
                                                    <select name="color">
                                                        @foreach($product->colors as $color)
                                                            <option value="{{$color->id}}">{{$color->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </p>
                                            </div>
                                            <div class="size-wrap">
                                                <p class="size-desc">
                                                    Size:
                                                    <select name="size" id="">
                                                        @foreach($product->sizes as $size)
                                                            <option value="{{$size->id}}">{{$size->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </p>
                                            </div>
                                            <div class="size-wrap">
                                                <p class="size-desc">
                                                    <label for="productqty"></label>
                                                    Quantity:
                                                    <select name="productqty" id="productqty">
                                                        <option value="0">Choose</option>
                                                        @for($i = 1;$i<11;$i++)
                                                            <option value="{{$i}}">{{$i}}</option>
                                                        @endfor
                                                    </select>
                                                </p>
                                            </div>
                                            @if(Auth::user())
                                                <button class="btn btn-primary btn-addtocart" @click="addtobasket(productId)"><i class="icon-shopping-cart"> Add to Cart</i></button>
                                                @else
                                                <a href="{{route('login')}}" class="btn btn-danger">Login (To Order)</a>
                                            @endif
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="row">
                            <div class="col-md-12 tabulation">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#description">Description</a></li>
                                    <li><a data-toggle="tab" href="#manufacturer">Manufacturer</a></li>
                                    <li><a data-toggle="tab" href="#review">Reviews</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="description" class="tab-pane fade in active">
                                        <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.</p>
                                        <p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane. Pityful a rethoric question ran over her cheek, then she continued her way.</p>
                                        <ul>
                                            <li>The Big Oxmox advised her not to do so</li>
                                            <li>Because there were thousands of bad Commas</li>
                                            <li>Wild Question Marks and devious Semikoli</li>
                                            <li>She packed her seven versalia</li>
                                            <li>tial into the belt and made herself on the way.</li>
                                        </ul>
                                    </div>
                                    <div id="manufacturer" class="tab-pane fade">
                                        <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.</p>
                                        <p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane. Pityful a rethoric question ran over her cheek, then she continued her way.</p>

                                    </div>
                                    <div id="review" class="tab-pane fade">
                                        <div class="row">
                                            <div class="col-md-7">
                                                <h3>23 Reviews</h3>
                                                <div class="review">
                                                    <div class="user-img" style="background-image: url(images/person1.jpg)"></div>
                                                    <div class="desc">
                                                        <h4>
                                                            <span class="text-left">Jacob Webb</span>
                                                            <span class="text-right">14 March 2018</span>
                                                        </h4>
                                                        <p class="star">
										   				<span>
										   					<i class="icon-star-full"></i>
										   					<i class="icon-star-full"></i>
										   					<i class="icon-star-full"></i>
										   					<i class="icon-star-half"></i>
										   					<i class="icon-star-empty"></i>
									   					</span>
                                                            <span class="text-right"><a href="#" class="reply"><i class="icon-reply"></i></a></span>
                                                        </p>
                                                        <p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrov</p>
                                                    </div>
                                                </div>
                                                <div class="review">
                                                    <div class="user-img" style="background-image: url(images/person2.jpg)"></div>
                                                    <div class="desc">
                                                        <h4>
                                                            <span class="text-left">Jacob Webb</span>
                                                            <span class="text-right">14 March 2018</span>
                                                        </h4>
                                                        <p class="star">
										   				<span>
										   					<i class="icon-star-full"></i>
										   					<i class="icon-star-full"></i>
										   					<i class="icon-star-full"></i>
										   					<i class="icon-star-half"></i>
										   					<i class="icon-star-empty"></i>
									   					</span>
                                                            <span class="text-right"><a href="#" class="reply"><i class="icon-reply"></i></a></span>
                                                        </p>
                                                        <p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrov</p>
                                                    </div>
                                                </div>
                                                <div class="review">
                                                    <div class="user-img" style="background-image: url(images/person3.jpg)"></div>
                                                    <div class="desc">
                                                        <h4>
                                                            <span class="text-left">Jacob Webb</span>
                                                            <span class="text-right">14 March 2018</span>
                                                        </h4>
                                                        <p class="star">
										   				<span>
										   					<i class="icon-star-full"></i>
										   					<i class="icon-star-full"></i>
										   					<i class="icon-star-full"></i>
										   					<i class="icon-star-half"></i>
										   					<i class="icon-star-empty"></i>
									   					</span>
                                                            <span class="text-right"><a href="#" class="reply"><i class="icon-reply"></i></a></span>
                                                        </p>
                                                        <p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrov</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-md-push-1">
                                                <div class="rating-wrap">
                                                    <h3>Give a Review</h3>
                                                    <p class="star">
									   				<span>
									   					<i class="icon-star-full"></i>
									   					<i class="icon-star-full"></i>
									   					<i class="icon-star-full"></i>
									   					<i class="icon-star-full"></i>
									   					<i class="icon-star-full"></i>
									   					(98%)
								   					</span>
                                                        <span>20 Reviews</span>
                                                    </p>
                                                    <p class="star">
									   				<span>
									   					<i class="icon-star-full"></i>
									   					<i class="icon-star-full"></i>
									   					<i class="icon-star-full"></i>
									   					<i class="icon-star-full"></i>
									   					<i class="icon-star-empty"></i>
									   					(85%)
								   					</span>
                                                        <span>10 Reviews</span>
                                                    </p>
                                                    <p class="star">
									   				<span>
									   					<i class="icon-star-full"></i>
									   					<i class="icon-star-full"></i>
									   					<i class="icon-star-full"></i>
									   					<i class="icon-star-empty"></i>
									   					<i class="icon-star-empty"></i>
									   					(98%)
								   					</span>
                                                        <span>5 Reviews</span>
                                                    </p>
                                                    <p class="star">
									   				<span>
									   					<i class="icon-star-full"></i>
									   					<i class="icon-star-full"></i>
									   					<i class="icon-star-empty"></i>
									   					<i class="icon-star-empty"></i>
									   					<i class="icon-star-empty"></i>
									   					(98%)
								   					</span>
                                                        <span>0 Reviews</span>
                                                    </p>
                                                    <p class="star">
									   				<span>
									   					<i class="icon-star-full"></i>
									   					<i class="icon-star-empty"></i>
									   					<i class="icon-star-empty"></i>
									   					<i class="icon-star-empty"></i>
									   					<i class="icon-star-empty"></i>
									   					(98%)
								   					</span>
                                                        <span>0 Reviews</span>
                                                    </p>
                                                </div>
                                            </div>
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
                        <h2><span>Similar Products</span></h2>
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
