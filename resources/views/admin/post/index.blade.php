@extends('admin.layouts.layout')

@section('content')


    <div id="app" class="main-content-container container-fluid px-4">
        <!-- Page Header -->
        <div class="page-header row no-gutters py-4">
            <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                <span class="text-uppercase page-subtitle">Dashboard</span>
                <h3 class="page-title">Products List</h3>
            </div>
        </div>
        <!-- End Page Header -->
        <a href="{{route('product.create')}}" class="mb-2 btn btn-info mr-2">Add new Product</a>
        <a href="{{route('size.index')}}" class="mb-2 btn btn-info mr-2">Sizes</a>
        <a href="{{route('color.index')}}" class="mb-2 btn btn-info mr-2">Colors</a>
        <a href="{{route('discount.index')}}" class="mb-2 btn btn-info mr-2">Discounts</a>

        <div class="row">
            <div class="col">
                <div class="card card-small mb-4">
                    <div class="card-header border-bottom">
                        <h6 class="m-0">Menus List</h6>
                    </div>
                    <div class="card-body p-0 pb-3 text-center">
                        <table class="table mb-0">
                            <thead class="bg-light">
                            <tr>
                                <th scope="col" class="border-0">Title</th>
                                <th scope="col" class="border-0">Price</th>
                                <th scope="col" class="border-0">Quantity</th>
                                <th scope="col" class="border-0">Status</th>
                                <th scope="col" class="border-0">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{$product->name}}</td>
                                    <td>
                                        @if(!$product->offerprice)
                                            @foreach($product->prices as $price)
                                                @if($loop->last)
                                                {{$price->originalprice}}
                                                @endif
                                            @endforeach
                                            @else
                                            @foreach($product->prices as $price)
                                                @if($loop->last)
                                                    <del><span class="text-danger">{{$price->originalprice}}</span></del>
                                                @endif
                                            @endforeach
                                                <br>
                                                {{$product->offerprice}}
                                        @endif
                                    </td>
                                    <td>{{$product->productquantity}}</td>
                                    <td>
                                        @switch($product->salable)
                                            @case(1)
                                        <span class="btn btn-success">Saleable</span>
                                            @break
                                            @case(0)
                                            <span class="btn btn-danger">UnSaleable</span>
                                            @break
                                        @endswitch
                                    </td>
                                    <td>
                                        <div class="blog-comments__actions">
                                            <div class="btn-group btn-group-sm">
                                                <button type="button" class="btn btn-white" @click="deleteRow({{$product->id}},'level')">
                              <span class="text-danger">
                                <i class="material-icons">clear</i>
                              </span> Delete
                                                </button>
                                                <a href="{{route('level.edit',['id' => $product->id])}}" class="btn btn-white">
                              <span class="text-light">
                                <i class="material-icons">more_vert</i>
                              </span> Edit
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach


                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

    </div>


@endsection