@extends('admin.layouts.layout')

@section('content')
    <div id="app" class="main-content-container container-fluid px-4">
        <!-- Page Header -->
        <div class="page-header row no-gutters py-4">
            <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                <span class="text-uppercase page-subtitle">Blog Posts</span>
                <h3 class="page-title">Add New Post</h3>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row">
            <div class="col-sm-6">
                @if ($errors->any())
                    <div class="text-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="text-danger" v-if="errors">
                    <ul>
                        <template v-for="error in errors">
                            <li v-for="r in error">@{{ r }}</li>
                        </template>

                    </ul>
                </div>
            </div>
        </div>
        <form action="{{route('product.update',['id' => $product->id])}}" method="POST" enctype="multipart/form-data" class="add-new-post">
            @csrf
            <div class="row">
                <div class="col-lg-9 col-md-12">
                    <!-- Add New Post Form -->
                    <div class="card card-small mb-3">
                        <div class="card-body">
                            <input name="name" class="form-control form-control-lg mb-3" type="text" placeholder="Your Post Title" value="{{$product->name}}">
                            <textarea name="description" class="form-control form-control-lg mb-3" id="" cols="30" rows="10">{{$product->description}}</textarea>
                        </div>
                    </div>

                    <div class="card card-small mb-3">
                        <div class="card-header">
                            Categories
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="originallPrice">Originall Price</label>
                                    @foreach($product->prices as $price)
                                        @if($loop->last)
                                    <input name="originallprice"  type="text" class="form-control" id="originallPrice" value="{{$price->originalprice}}">
                                        @endif
                                    @endforeach
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="offerPrice">Offer Price</label>
                                    <input name="offerprice" type="text" class="form-control" id="offerPrice" value="{{$product->offerprice}}">
                                </div>

                                <div class="form-group col-sm-6">
                                    <label for="productQuantity">Quantity</label>
                                    <input name="quantity" type="number" class="form-control" id="productQuantity" value="{{$product->productquantity}}">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="productWeight">Weight</label>
                                    <input name="weight" type="number" class="form-control" id="productWeight" value="{{$product->weight}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-small mb-3">
                        <div class="card-header">
                            Upload Image
                        </div>

                        <imageproduct-component :product-images='@json($product->images)' :product-id="{{$product->id}}"></imageproduct-component>
                        <div class="card-body">
                            <div class="input-group control-group increment" >
                                <input ref="imagess" type="file" name="images[]" class="form-control">
                                <div class="input-group-btn">
                                    <button class="btn btn-success addButton" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
                                </div>
                            </div>
                            <div class="clone hide" style="display: none">
                                <div class="control-group input-group" style="margin-top:10px">
                                    <input ref="imagess" type="file" name="images[]" class="form-control">
                                    <div class="input-group-btn">
                                        <button class="btn btn-danger removeBotton" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-small mb-3">
                        <div class="card-header">
                            Categories
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item px-3 pb-2" style="max-height: 300px;overflow-y: scroll;">
                                    @foreach($categorys as $key => $category)
                                        <h5>{{$key}}</h5>
                                        @foreach($category as $cats)
                                            @foreach($cats as $cat)
                                                <h6 style="margin-left: 15px;">+ {{$cat['name']}}</h6>
                                                @foreach($cat['subcategories'] as $sub)
                                                    <div class="custom-control custom-checkbox mb-1" style="margin-left: 35px;">
                                                        <input name="subcategory[]" type="checkbox" class="custom-control-input" id="category{{$sub['id']}}" value="{{$sub['id']}}" @if(is_array(old('subcategory')) && in_array($sub['id'],old('subcategory'))) checked @endif @foreach($product->subcategorys as $thiscategory) @if($sub['id'] == $thiscategory->id) checked @endif @endforeach>
                                                        <label class="custom-control-label" for="category{{$sub['id']}}">{{$sub['name']}}</label>
                                                    </div>
                                                @endforeach
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                </li>
                                <li class="list-group-item d-flex px-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="New category" aria-label="Add new category" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-white px-2" type="button">
                                                <i class="material-icons">add</i>
                                            </button>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- / Add New Post Form -->
                </div>
                <div class="col-lg-3 col-md-12">
                    <!-- Post Overview -->
                    <div class='card card-small mb-3'>
                        <div class="card-header border-bottom">
                            <h6 class="m-0">Actions</h6>
                        </div>
                        <div class='card-body p-0'>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item p-3">
                        <span class="d-flex mb-2">
                          <i class="material-icons mr-1">flag</i>
                          <strong class="mr-1">Status:</strong> Draft
                          <a class="ml-auto" href="#">Edit</a>
                        </span>
                                    <span class="d-flex mb-2">
                          <i class="material-icons mr-1">visibility</i>
                          <strong class="mr-1">Visibility:</strong>
                          <strong class="text-success">Public</strong>
                          <a class="ml-auto" href="#">Edit</a>
                        </span>
                                    <span class="d-flex mb-2">
                          <i class="material-icons mr-1">calendar_today</i>
                          <strong class="mr-1">Schedule:</strong> Now
                          <a class="ml-auto" href="#">Edit</a>
                        </span>
                                    <span class="d-flex">
                          <i class="material-icons mr-1">score</i>
                          <strong class="mr-1">Readability:</strong>
                          <strong class="text-warning">Ok</strong>
                        </span>
                                </li>
                                <li class="list-group-item d-flex px-3">
                                    <a class="btn btn-sm btn-outline-accent" @click="unSaleable">
                                        <i class="material-icons">save</i>Draft</a>
                                    <button class="btn btn-sm btn-accent ml-auto">
                                        <i class="material-icons">file_copy</i>Edit</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- / Post Overview -->
                    <!-- Product Discount -->
                    <div class='card card-small mb-3'>
                        <div class="card-header border-bottom">
                            <h6 class="m-0">Author</h6>
                        </div>
                        <div class='card-body p-0'>
                            <div class="form-group" style="padding: 10px 10px 0 10px;">
                                <select name="user_id" class="form-control">
                                    <option value="{{$product->user->id}}">{{$product->user->name}}</option>
                                    <option value="" disabled>Choose User</option>
                                    @foreach($authors as $author)
                                        <option value="{{$author->id}}">{{$author->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- / Product Discount -->

                    <!-- Product Discount -->
                    <div class='card card-small mb-3'>
                        <div class="card-header border-bottom">
                            <h6 class="m-0">Discount</h6>
                        </div>
                        <div class='card-body p-0'>
                            <div class="form-group" style="padding: 10px 10px 0 10px;">
                                <select name="discount_id" class="form-control">
                                    @if($product->discount)
                                    <option value="{{$product->discount->id}}">{{$product->discount->discountcode}}</option>
                                    @endif
                                        <option value="">Choose...</option>
                                    @foreach($discounts as $discount)
                                        @if(old('discount_id') == $discount->id)
                                            <option value="{{$discount->id}}" selected>{{$discount->discountcode}}</option>
                                        @else
                                            <option value="{{$discount->id}}">{{$discount->discountcode}}</option>
                                        @endif

                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- / Product Discount -->
                    <!-- Product Color -->
                    <div class='card card-small mb-3'>
                        <div class="card-header border-bottom">
                            <h6 class="m-0">Color</h6>
                        </div>
                        <div class='card-body p-0' style="max-height: 200px;overflow-y: scroll;">
                            @foreach($colors as $color)
                                <div class="custom-control custom-checkbox mb-1" style="margin-left: 35px;">
                                    <input type="checkbox" class="custom-control-input" id="color{{$color->id}}" value="{{$color->id}}" name="color[]" @if(is_array(old('color')) && in_array($color->id,old('color'))) checked @endif @foreach($product->colors as $thiscolor) @if($color->id == $thiscolor->id) checked @endif @endforeach>
                                    <label class="custom-control-label" for="color{{$color->id}}">{{$color->name}}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- / Product Color -->
                    <!-- Product Size -->
                    <div class='card card-small mb-3'>
                        <div class="card-header border-bottom">
                            <h6 class="m-0">Size</h6>
                        </div>
                        <div class='card-body p-0' style="max-height: 200px;overflow-y: scroll;">
                            @foreach($sizes as $size)
                                <div class="custom-control custom-checkbox mb-1" style="margin-left: 35px;">
                                    <input name="size[]" type="checkbox" class="custom-control-input" id="size{{$size->id}}" value="{{$size->id}}" @if(is_array(old('size')) && in_array($size->id,old('size'))) checked @endif @foreach($product->sizes as $thissize) @if($size->id == $thissize->id) checked @endif @endforeach>
                                    <label class="custom-control-label" for="size{{$size->id}}">{{$size->name}}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- / Product Size -->

                </div>
            </div>
        </form>
    </div>


@endsection

@section('css')
    <link rel="stylesheet" href="/admin/styles/quill.snow.css">
@endsection
@section('js')
    <script src="/admin/scripts/quill.min.js"></script>
    <script src="/admin/scripts/app/app-blog-new-post.1.1.0.js"></script>
    <script type="text/javascript">

        $(document).ready(function() {

            $(".addButton").click(function(){
                var html = $(".clone").html();
                $(".increment").after(html);
            });

            $("body").on("click",".removeBotton",function(){
                $(this).parents(".control-group").remove();
            });

        });

    </script>

@endsection