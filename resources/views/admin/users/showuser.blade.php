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
                        <h6 class="m-0">Add New Menu</h6>
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
                                    <form action="{{route('admin.user.updateuser',['id' => $user->id])}}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <input name="name" type="text" class="form-control" id="inputAddress" placeholder="Name" value="{{$user->name}}">
                                        </div>
                                        <div class="form-group">
                                            <input name="email" type="text" class="form-control" id="inputAddress" placeholder="Email" value="{{$user->email}}">
                                        </div>
                                        <div class="form-group">
                                            <input name="password" type="text" class="form-control" id="inputAddress" placeholder="Password">
                                        </div>

                                        <div class="form-group">
                                            <select class="form-control" name="level_id" id="">
                                                <option value="{{$user->level_id}}">
                                                    @if($user->level_id == 0)
                                                        User
                                                    @elseif($user->level_id == 1)
                                                        Admin
                                                    @endif
                                                </option>
                                                <option value="0">User</option>
                                                <option value="1">Admin</option>
                                            </select>
                                        </div>

                                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
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