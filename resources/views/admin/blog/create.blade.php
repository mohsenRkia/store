@extends('admin.layouts.layout')

@section('content')

<div class="main-content-container container-fluid px-4">
    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Blog Posts</span>
            <h3 class="page-title">Add New Blog</h3>
        </div>
    </div>
    <!-- End Page Header -->
    <form method="POST" action="{{route('admin.blog.store')}}" enctype="multipart/form-data">
    <div class="row">

        <div class="col-md-12">
            <!-- Add New Post Form -->
            <div class="card card-small mb-3">
                <div class="card-body">
                        @csrf
                    <input name="title" class="form-control form-control-lg mb-3" type="text" placeholder="Your Post Title" value="{{old('title')}}">
                    <textarea placeholder="Your Text" class="form-control form-control-lg mb-3" name="description"></textarea>
                    <div class="form-group"><div class="custom-file"><input type="file" id="validatedCustomFile" name="image" class="custom-file-input"> <label for="validatedCustomFile" class="custom-file-label">Choose file...</label></div></div>
                </div>
            </div>
            <!-- / Add New Post Form -->
        </div>
        <div class="col-md-12">
            <!-- Post Overview -->
            <div class='card card-small mb-3'>
                <div class="card-header border-bottom">
                    <h6 class="m-0">Actions</h6>
                </div>
                <div class='card-body p-0'>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex px-3">
                            <button class="btn btn-sm btn-outline-accent">
                                <i class="material-icons">save</i> Save Draft</button>
                            <button type="submit" class="btn btn-sm btn-accent ml-auto">
                                <i class="material-icons">file_copy</i> Publish</button>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- / Post Overview -->

        </div>


    </div>
    </form>
</div>


@endsection