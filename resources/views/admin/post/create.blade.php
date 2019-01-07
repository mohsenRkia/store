@extends('admin.layouts.layout')

@section('content')


    <div class="main-content-container container-fluid px-4">
        <!-- Page Header -->
        <div class="page-header row no-gutters py-4">
            <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                <span class="text-uppercase page-subtitle">Blog Posts</span>
                <h3 class="page-title">Add New Post</h3>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row">
            <div class="col-lg-9 col-md-12">
                <!-- Add New Post Form -->
                <div class="card card-small mb-3">
                    <div class="card-body">
                        <form class="add-new-post">
                            <input class="form-control form-control-lg mb-3" type="text" placeholder="Your Post Title">
                            <div id="editor-container" class="add-new-post__editor mb-1"></div>
                        </form>
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
                                <button class="btn btn-sm btn-outline-accent">
                                    <i class="material-icons">save</i> Save Draft</button>
                                <button class="btn btn-sm btn-accent ml-auto">
                                    <i class="material-icons">file_copy</i> Publish</button>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- / Post Overview -->
                <!-- Post Overview -->
                <div class='card card-small mb-3'>
                    <div class="card-header border-bottom">
                        <h6 class="m-0">Categories</h6>
                    </div>
                    <div class='card-body p-0'>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item px-3 pb-2" style="height: 300px;overflow-y: scroll;">
                                @foreach($categorys as $key => $category)
                                    <h5>{{$key}}</h5>
                                    @foreach($category as $cats)
                                        @foreach($cats as $cat)
                                        <h6 style="margin-left: 15px;">+ {{$cat['name']}}</h6>
                                            @foreach($cat['subcategories'] as $sub)
                                                <div class="custom-control custom-checkbox mb-1" style="margin-left: 35px;">
                                                    <input type="checkbox" class="custom-control-input" id="category{{$sub['id']}}" value="{{$sub['id']}}">
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
                <!-- / Post Overview -->
            </div>
        </div>
    </div>


@endsection

@section('css')
    <link rel="stylesheet" href="/admin/styles/quill.snow.css">
@endsection
@section('js')
    <script src="/admin/scripts/quill.min.js"></script>
    <script src="/admin/scripts/app/app-blog-new-post.1.1.0.js"></script>
@endsection