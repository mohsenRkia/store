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
                        <h6 class="m-0">{{$message->firstname}} {{$message->lastname}} ({{$message->email}})</h6>
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

                                    <h4><span class="text-danger">{{$message->subject}}</span></h4>

                                    <p>{{$message->message}}</p>

                                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>

                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>


    </div>


@endsection