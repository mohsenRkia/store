@extends('admin.layouts.layout')

@section('content')


    <div id="app" class="main-content-container container-fluid px-4">
        <!-- Page Header -->
        <div class="page-header row no-gutters py-4">
            <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                <span class="text-uppercase page-subtitle">Dashboard</span>
                <h3 class="page-title">Orders List</h3>
            </div>
        </div>
        <!-- End Page Header -->
        <a href="{{route('cart.index')}}" class="mb-2 btn btn-info mr-2">Go to Hasn't Sent List</a>

        <div class="row">
            <div class="col">
                <div class="card card-small mb-4">
                    <div class="card-header border-bottom">
                        <h6 class="m-0">Orders List</h6>
                    </div>
                    <div class="card-body p-0 pb-3 text-center">
                        <table class="table mb-0">
                            <thead class="bg-light">
                            <tr>
                                <th scope="col" class="border-0">Status</th>
                                <th scope="col" class="border-0">User</th>
                                <th scope="col" class="border-0">Total Price</th>
                                <th scope="col" class="border-0">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($factors as $factor)
                                <tr>
                                    <td>
                                        @switch($factor->sent)
                                            @case(1)
                                            <span class="btn btn-success">Has Sent</span>
                                            @break
                                            @case(0)
                                            <span class="btn btn-danger">Hasn't Sent</span>
                                            @break
                                        @endswitch
                                    </td>
                                    <td>{{$factor->user->name}}</td>
                                    <td>{{$factor->total}}</td>
                                    <td>
                                        <div class="blog-comments__actions">
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{route('cart.show',['id' => $factor->id])}}" class="btn btn-white">
                              <span class="text-light">
                                <i class="material-icons">more_vert</i>
                              </span> Show
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
                {{$factors->links()}}
            </div>
        </div>

    </div>


@endsection