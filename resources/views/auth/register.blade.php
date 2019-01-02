@extends('site.layouts.layout')

@section('content')
    <aside id="colorlib-hero" class="breadcrumbs">
        <div class="flexslider">
            <ul class="slides">
                <li style="background-image: url('/site/images/cover-img-1.jpg');">
                    <div class="overlay"></div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3 col-sm-12 col-xs-12 slider-text">
                                <div class="slider-text-inner text-center">
                                    <h1>Register</h1>
                                    <h2 class="bread"><span><a href="{{route('home.index')}}">Home</a></span> <span>Register</span></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </aside>
    <div id="colorlib-contact">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="contact-wrap">
                        <form method="POST" action="{{ route('register.store') }}">
                            @csrf
                            <div class="row form-group">
                                <div class="col-md-12 padding-bottom">
                                    <label for="fname">Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Your Name" value="{{ old('name') }}" autofocus>
                                </div>
                                @if ($errors->has('name'))
                                    <div class="col-md-12">
                                    <div class="text-danger">
                                            {{ $errors->first('name') }}
                                        </div>
                                        </div>
                                @endif
                            </div>

                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" placeholder="Your email address" name="email" value="{{ old('email') }}">
                                </div>
                                @if ($errors->has('email'))
                                    <div class="col-md-12">
                                        <div class="text-danger">
                                            {{ $errors->first('email') }}
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label for="subject">Password</label>
                                    <input id="password" type="password" placeholder="Password" class="form-control" name="password">
                                </div>
                                @if ($errors->has('password'))
                                    <div class="col-md-12">
                                        <div class="text-danger">
                                            {{ $errors->first('password') }}
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label for="subject">Confirm Password</label>
                                    <input id="password-confirm" type="password" placeholder="Confirm Password" class="form-control" name="password_confirmation">
                                </div>
                            </div>

                            <div class="form-group text-center">
                                <input type="submit" value="Send Message" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
