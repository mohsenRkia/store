@extends('user.layouts.layout')

@section('content')


    <div id="app" class="main-content-container container-fluid px-4">
        <!-- Page Header -->
        <div class="page-header row no-gutters py-4">
            <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                <span class="text-uppercase page-subtitle">Dashboard</span>
                <h3 class="page-title">Factor List</h3>
            </div>
        </div>
        <!-- End Page Header -->

        <div class="row">
            <div class="col">

                <div class="col-md-12 col-sm-12 mb-4">
                    <div class="card card-small blog-comments">
                        <div class="card-header border-bottom">
                            <h6 class="m-0">
                                <span>
                                @switch($factor->sent)
                                        @case(1)
                                        <span class="btn btn-success">Has Sent</span>
                                        @break
                                        @case(0)
                                        <span class="btn btn-danger">Hasn't Sent</span>
                                        @break
                                    @endswitch
                            </span>
                                Orders</h6>
                        </div>
                        @foreach($factor->carts as $cart)
                            <div class="card-body p-0">
                                <div class="blog-comments__item d-flex p-3">
                                    <div class="blog-comments__avatar mr-3">
                                        @foreach($cart->product->images as $key => $image)
                                            @if($key == 0)
                                                <img src="/uploads/images/products/{{$image->url}}" alt="Product Image"> </div>
                                    @endif
                                    @endforeach
                                    <div class="blog-comments__content">
                                        <div class="blog-comments__meta text-muted">
                                            <a class="text-secondary" href="{{route('site.product.show',['id' => $cart->product->id,'slug' => $cart->product->slug])}}">{{$cart->product->name}}</a>
                                            <span class="text-muted">| Quantity : {{$cart->productqty}}</span>
                                            |
                                            <span class="text-muted"> Price : ${{$cart->totalprice}}</span>
                                        </div>
                                        <p class="m-0 my-1 mb-2 text-muted">{{$cart->product->description}}</p>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="card-footer border-top">
                            <div class="row">
                                <div class="col view-report">
                                    <button type="submit" class="btn btn-white">Total Price :
                                        @if($factor->status == 1)
                                            ${{$factor->total}}
                                        @else
                                            ---
                                        @endif
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


@endsection