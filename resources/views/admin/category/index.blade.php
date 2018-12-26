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
            <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                <a href="{{route('category.list')}}">
                    <div class="card card-small h-100">
                        <div class="card-body text-center">
                            <div class="" style="font: 25px Tahoma;padding: 100px">Show List</div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                <div class="card card-small h-100">
                    <a href="{{route('category.add')}}">
                        <div class="card card-small h-100">
                            <div class="card-body text-center">
                                <div class="" style="font: 25px Tahoma;padding: 100px">Add New Category</div>
                            </div>

                        </div>
                    </a>

                </div>
            </div>

        </div>


    </div>


@endsection