@extends('admin.layouts.layout')

@section('content')
    <div id="app" class="main-content-container container-fluid px-4">
        <!-- Page Header -->
        <div class="page-header row no-gutters py-4">
            <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                <span class="text-uppercase page-subtitle">Overview</span>
                <h3 class="page-title">User Profile</h3>
            </div>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
    @endif
    <!-- Default Light Table -->
        <div class="row">
            <div class="col-lg-4">
                <div class="card card-small mb-4 pt-3">
                    <div class="card-header border-bottom text-center">
                        <div class="mb-3 mx-auto">
                            <img class="rounded-circle" src="/avatar.png" alt="User Avatar" width="110"> </div>
                    <h4 class="mb-0">Site Title</h4>
                    <span class="text-muted d-block mb-2">Here is Level</span>
                </div>

            </div>
        </div>
        <div class="col-lg-8">
            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Account Details</h6>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item p-3">
                        <div class="row">
                            <div class="col">
                                @if($countSetting == 0)
                                    <form method="POST" action="{{route('admin.setting.store')}}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="comment">Comment</label>
                                                <select name="comment" id="" class="form-control">
                                                    <option value="0">Deactive</option>
                                                    <option value="1">Active</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="logintocomment">Login To Comment</label>
                                                <select name="logintocomment" id="" class="form-control">
                                                    <option value="0">Deactive</option>
                                                    <option value="1">Active</option>
                                                </select>
                                            </div>
                                        </div>
                                        <hr>

                                        <button type="submit" class="btn btn-accent">Update Account</button>
                                    </form>

                                @elseif($countSetting == 1)
                                    @foreach($setting as $item)
                                        <form method="POST" action="{{route('admin.setting.update',['id' => $item->id])}}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="comment">Comment</label>
                                                <select name="comment" id="" class="form-control">
                                                    @switch($item->comment)
                                                        @case(1)
                                                        <option value="{{$item->comment}}">Active</option>
                                                        <option value="0">Deactive</option>
                                                        @break

                                                        @case(0)
                                                        <option value="{{$item->comment}}">Deactive</option>
                                                        <option value="1">Active</option>
                                                        @break
                                                    @endswitch
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="logintocomment">Login To Comment</label>
                                                <select name="logintocomment" id="" class="form-control">
                                                    @switch($item->login_to_comment)
                                                        @case(1)
                                                        <option value="{{$item->login_to_comment}}">Active</option>
                                                        <option value="0">Deactive</option>
                                                        @break

                                                        @case(0)
                                                        <option value="{{$item->login_to_comment}}">Deactive</option>
                                                        <option value="1">Active</option>
                                                        @break
                                                    @endswitch
                                                </select>
                                            </div>
                                        </div>
                                        <hr>

                                        <button type="submit" class="btn btn-accent">Update Account</button>
                                    </form>
                                    @endforeach
                                @endif

                            </div>

                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End Default Light Table -->
    <script language="javascript">
        populateCountries("countryName", "stateName"); // first parameter is id of country drop-down and second parameter is id of state drop-down
    </script>
@endsection