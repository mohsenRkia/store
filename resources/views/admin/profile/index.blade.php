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
                        @if($profile->image)
                        <img class="rounded-circle" src="/uploads/images/avatars/{{$profile->image->url}}" alt="User Avatar" width="110"> </div>
                    @else
                        <img class="rounded-circle" src="/avatar.png" alt="User Avatar" width="110"> </div>
                    @endif

                    <h4 class="mb-0">{{$profile->name}}</h4>
                    <span class="text-muted d-block mb-2">Here is Level</span>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item px-4">
                        <div class="progress-wrapper">
                            <strong class="text-muted d-block mb-2">Workload</strong>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="74" aria-valuemin="0" aria-valuemax="100" style="width: 74%;">
                                    <span class="progress-value">74%</span>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li style="list-style: none">
                        <div class="card">
                            <div class="alert alert-info">
                                Change Password
                            </div>
                            <div class="card card-body">
                        <form action="{{route('profile.changepassword',['id' => Auth::user()->id])}}" method="POST">
                            @csrf
                            <div class="form-group col-md-12">
                                <label for="feOldPassword">Old Password</label>
                                <input type="password" name="oldpassword" class="form-control" id="feOldPassword" placeholder="Old Password">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="fePassword">New Password</label>
                                <input type="password" name="password" class="form-control" id="fePassword" placeholder="New Password">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="password-confirm">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control" id="password-confirm" placeholder="Confirm Password">
                            </div>

                            <button type="submit" class="btn btn-accent">Change Password</button>
                        </form>
                            </div>
                        </div>
                    </li>
                </ul>
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
                                <form method="POST" action="{{route('profile.update',['id' => Auth::user()->id])}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="feFirstName">First Name</label>
                                            <input type="text" name="firstname" class="form-control" id="feFirstName" placeholder="First Name" value="{{$profile->profile->firstname}}"> </div>
                                        <div class="form-group col-md-6">
                                            <label for="feLastName">Last Name</label>
                                            <input type="text" name="lastname" class="form-control" id="feLastName" placeholder="Last Name" value="{{$profile->profile->lastname}}"> </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="feEmailAddress">Email</label>
                                            <input type="email" name="email" class="form-control" id="feEmailAddress" placeholder="Email" value="{{$profile->email}}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="phone">Phone</label><br>
                                            <input type="tel" name="phone" id="phone" class="form-control" placeholder="Phone Number" value="{{$profile->profile->phone}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="feInputAddress">Address</label>
                                        <input type="text" name="address" class="form-control" id="feInputAddress" placeholder="1234 Main St" value="{{$profile->profile->address}}"> </div>
                                    @if($profile->profile->state)
                                    <selectstate-component :list-countries='@json($countries)' zip-code="{{$profile->profile->zipcode}}" default-state-name="{{$profile->profile->state->name}}" default-stat-value="{{$profile->profile->state->id}}" default-country="{{$profile->profile->state->country->name}}"></selectstate-component>
                                    @else
                                        <selectstate-component :list-countries='@json($countries)' zip-code="{{$profile->profile->zipcode}}" default-state-name="Choose" default-stat-value="" default-country="Choose"></selectstate-component>
                                    @endif
                                    <hr>
                                    <h5>BirthDate</h5>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="feInputState">Year</label>
                                            <select id="feInputState" class="form-control" name="year">
                                                @if($date)
                                                <option value="{{$date->year}}">{{$date->year}}</option>
                                                @else
                                                    <option value="">Year</option>
                                                @endif
                                                @for($i=1900;$i<2020;$i++)
                                                <option value="{{$i}}">{{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="feInputState">Month</label>
                                            <select id="feInputState" class="form-control" name="month">
                                                @if($date)
                                                <option value="{{$date->month}}">{{$date->month}}</option>
                                                @else
                                                    <option value="">Month</option>
                                                @endif
                                                @for($i=1;$i<13;$i++)
                                                <option value="{{$i}}">{{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="feInputState">Day</label>
                                            <select id="feInputState" class="form-control" name="day">
                                                @if(!$date == null)
                                                <option value="{{$date->day}}">{{$date->day}}</option>
                                                @else
                                                <option value="">Day</option>
                                                @endif
                                                @for($i=1;$i<32;$i++)
                                                <option value="{{$i}}">{{$i}}</option>
                                                    @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <hr>
                                    <h5>Avatar</h5>
                                    <div class="form-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="validatedCustomFile" name="avatar">
                                            <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-accent">Update Account</button>
                                </form>
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