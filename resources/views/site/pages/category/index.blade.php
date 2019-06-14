@extends('site.layouts.layout')

@section('content')


<div class="colorlib-blog">
    <div class="container">
        <div class="row">
            @if($collections)
                @foreach($collections as $collection)
            @foreach($collection as $product)
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
                        </div>
                    </div>
                </div>
            @endforeach
                @endforeach
                @endif
        </div>
    </div>
</div>

@endsection