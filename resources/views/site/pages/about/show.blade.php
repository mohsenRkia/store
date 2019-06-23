@extends('site.layouts.layout')

@section('content')
<div id="colorlib-about">
    <div class="container">
        @if(!is_null($about))
        <div class="row">
            <div class="about-flex">
                <div class="col-one-forth">
                    <div class="row">
                        <div class="col-md-12 about">
                            <img class="img-responsive" src="/uploads/images/about/{{$about->image->url}}" alt="">

                        </div>
                    </div>
                </div>
                <div class="col-three-forth">
                    <h2>{{$about->title}}</h2>
                    <div class="row">
                        <div class="col-md-12">
                            <p>{{$about->description}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            @endif
    </div>
</div>
@endsection