@extends('admin.layouts.layout')

@section('content')


    <div class="main-content-container container-fluid px-4">
        <!-- Page Header -->
        <div class="page-header row no-gutters py-4">
            <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                <span class="text-uppercase page-subtitle">Dashboard</span>
                <h3 class="page-title">Blog Overview</h3>
            </div>
        </div>
        <!-- End Page Header -->

        <div class="row">
            <div class="col-lg-2">
            </div>
            <div class="col-lg-8 mb-4">
                <div class="card card-small mb-4">
                    <div class="card-header border-bottom">
                        <h6 class="m-0">Add New SpecialOffer</h6>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item p-3">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="row">

                                @if($special)
                                <div class="col-sm-12">
                                    <form action="{{route('special.update',['id' => $special->id])}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <input name="title" type="text" class="form-control" id="inputAddress" placeholder="Title" value="{{$special->title}}">
                                        </div>
                                        <div class="form-group">
                                            <input name="link" type="text" class="form-control" id="inputAddress" placeholder="Link" value="{{$special->link}}">
                                        </div>
                                        <div class="form-group">
                                            <input name="discountvalue" type="number" class="form-control" id="inputAddress" placeholder="Discount Value" value="{{$special->discountvalue}}">
                                        </div>
                                        <div class="form-group">
                                            <textarea name="description" type="text" class="form-control" id="inputAddress" placeholder="Description">{{$special->description}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-file">
                                                <input name="urlimage" type="file" class="custom-file-input">
                                                <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                            </div>
                                        </div>

                                        <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
                                        <button type="reset" class="btn btn-secondary">Reset</button>
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </form>
                                </div>
                                    @else
                                    <div class="col-sm-12">
                                        <form action="{{route('special.store')}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <input name="title" type="text" class="form-control" id="inputAddress" placeholder="Title" value="{{old('title')}}">
                                            </div>
                                            <div class="form-group">
                                                <input name="link" type="text" class="form-control" id="inputAddress" placeholder="Link" value="{{old('link')}}">
                                            </div>
                                            <div class="form-group">
                                                <input name="discountvalue" type="number" class="form-control" id="inputAddress" placeholder="Discount Value" value="{{old('discountvalue')}}">
                                            </div>
                                            <div class="form-group">
                                                <textarea name="description" type="text" class="form-control" id="inputAddress" placeholder="Description">{{old('description')}}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-file">
                                                    <input name="urlimage" type="file" class="custom-file-input">
                                                    <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                                </div>
                                            </div>

                                            <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
                                            <button type="reset" class="btn btn-secondary">Reset</button>
                                            <button type="submit" class="btn btn-success">Submit</button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>


    </div>


@endsection