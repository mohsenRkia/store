@extends('site.layouts.layout')
@section('title')
{{$blog->title}}
@endsection
@section('content')
<div id="colorlib-about">
    <div class="container">
        <div class="row">
            <div class="about-flex">
                <div class="col-one-forth">
                    <div class="row">
                        <div class="col-md-12 about">
                            <img class="img-responsive" src="/uploads/images/blog/{{$blog->image->url}}" alt="">

                        </div>
                    </div>
                </div>
                <div class="col-three-forth">
                    <h2>{{$blog->title}}</h2>
                    <div class="row">
                        <div class="col-md-12">
                            <p>{{$blog->description}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection