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
        <a href="{{route('slider.add')}}" class="mb-2 btn btn-info mr-2">Add new Slider</a>

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
                                <th scope="col" class="border-0">BigTitle</th>
                                <th scope="col" class="border-0">SmallTitle</th>
                                <th scope="col" class="border-0">Reason</th>
                                <th scope="col" class="border-0">Description</th>
                                <th scope="col" class="border-0">Photo</th>
                                <th scope="col" class="border-0">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sliders as $slider)
                                <tr>
                                    <td>{{$slider->bigtitle}}</td>
                                    <td>{{$slider->smalltitle}}</td>
                                    <td>{{$slider->reason}}</td>
                                    <td>{{$slider->description}}</td>
                                    <td><img src="/uploads/images/slider/{{$slider->urlimage}}" alt="" width="100" height="50"></td>
                                    <td>
                                        <div class="blog-comments__actions">
                                            <div class="btn-group btn-group-sm">
                                                <button type="button" class="btn btn-white" @click="deleteRow({{$slider->id}},'slider')">
                              <span class="text-danger">
                                <i class="material-icons">clear</i>
                              </span> Delete
                                                </button>
                                                <a href="{{route('slider.edit',['id' => $slider->id])}}" class="btn btn-white">
                              <span class="text-light">
                                <i class="material-icons">more_vert</i>
                              </span> Edit
                                                </a>
                                                <a target="_blank" href="{{$slider->link}}" class="btn btn-white">
                              <span class="text-success">
                                <i class="material-icons">check</i>
                              </span> Visit </a>
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