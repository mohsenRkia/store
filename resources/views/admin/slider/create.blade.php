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
                        <h6 class="m-0">Add New Slider</h6>
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

                                <div class="col-sm-12">
                                    <form action="{{route('slider.store')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <input name="bigtitle" type="text" class="form-control" id="inputAddress" placeholder="Big Title" value="{{old('bigtitle')}}">
                                        </div>
                                        <div class="form-group">
                                            <input name="smalltitle" type="text" class="form-control" id="inputAddress" placeholder="Small Title" value="{{old('smalltitle')}}">
                                        </div>
                                        <div class="form-group">
                                            <input name="reason" type="text" class="form-control" id="inputAddress" placeholder="Reason" value="{{old('reason')}}">
                                        </div>
                                        <div class="form-group">
                                            <input name="link" type="text" class="form-control" id="inputAddress" placeholder="Link" value="{{old('link')}}">
                                        </div>
                                        <div class="form-group">
                                            <textarea name="description" type="text" class="form-control" id="inputAddress" placeholder="Description">{{old('description')}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="loCation">Info Location</label>
                                            <select class="form-control" name="location" id="loCation">
                                                <option value="L">Left</option>
                                                <option value="R">Right</option>
                                            </select>
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
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>


    </div>


@endsection