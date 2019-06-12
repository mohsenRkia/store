@extends('admin.layouts.layout')

@section('content')


    <div id="app" class="main-content-container container-fluid px-4">
        <!-- Page Header -->
        <div class="page-header row no-gutters py-4">
            <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                <span class="text-uppercase page-subtitle">Dashboard</span>
                <h3 class="page-title">Factor List</h3>
            </div>
        </div>
        <!-- End Page Header -->

        <div class="row">
            <div class="col">

                <div class="col-md-12 col-sm-12 mb-4">
                    <div class="card card-small blog-comments">
                        <div class="card-header border-bottom">
                            <h6 class="m-0">
                                <span>
                                    @if($cm->status == 0)
                                        <span class="btn btn-danger">Deactive</span>
                                    @else
                                        <span class="btn btn-success">Active</span>
                                    @endif

                            </span>
                                </h6>
                        </div>
                            <div class="card-body p-0">
                                <div class="blog-comments__item d-flex p-3">
                                    <div class="blog-comments__avatar mr-3">
                                        @if($cm->user->image)
                                    <img src="/uploads/images/avatars/{{$cm->user->image->url}}" alt="Product Image">
                                    @else
                                    <img src="/avatar.png" alt="Product Image">

                                    @endif


                                    </div>
                                    <div class="blog-comments__content">
                                        <div class="blog-comments__meta text-muted">
                                            <a class="text-secondary" href="{{route('site.product.show',['id' => $cm->id,'slug' => $cm->slug])}}">{{$cm->user->name}}</a>
                                            @if(!$cm->user->profile->state == null)
                                            <span class="text-muted"> | State : {{$cm->user->profile->state->name}}</span> | <span class="text-muted"> Country : {{$cm->user->profile->state->country->name}}</span>
                                                @endif
                                        </div>
                                        <p class="m-0 my-1 mb-2 text-muted">{{$cm->body}}</p>

                                    </div>
                                </div>
                            </div>
                        <div class="card-footer border-top">
                                <activecomments-component comment-id="{{$cm->id}}" :status="{{$cm->status}}"></activecomments-component>
                        </div>
                    </div>
                </div>


            </div>

        </div>

    </div>
@endsection