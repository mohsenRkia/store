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
        <a href="{{route('offeritem.add')}}" class="mb-2 btn btn-info mr-2">Add new Offer</a>

        <div class="row">
            <div class="col">
                <div class="card card-small mb-4">
                    <div class="card-header border-bottom">
                        <h6 class="m-0">Menus List</h6>
                    </div>
                    <div class="card-body p-0 pb-3 text-center">
                        <table class="table mb-0">
                            <thead class="bg-light">
                            <tr>
                                <th scope="col" class="border-0">Title</th>
                                <th scope="col" class="border-0">Location</th>
                                <th scope="col" class="border-0">Photo</th>
                                <th scope="col" class="border-0">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($offers as $offer)
                                <tr>
                                    <td>{{$offer->title}}</td>
                                    <td>
                                        @switch($offer->location)
                                            @case("L")
                                            Large
                                            @break
                                            @case("M")
                                            Medium
                                            @break
                                            @case("SR")
                                        Small Right
                                            @break
                                            @case("SL")
                                        Small Left
                                            @break
                                        @endswitch
                                    </td>
                                    <td><img src="/uploads/images/offers/{{$offer->imageurl}}" alt="" width="100"></td>
                                    <td>
                                        <div class="blog-comments__actions">
                                            <div class="btn-group btn-group-sm">
                                                <button type="button" class="btn btn-white" @click="deleteRow({{$offer->id}},'offeritem')">
                              <span class="text-danger">
                                <i class="material-icons">clear</i>
                              </span> Delete
                                                </button>
                                                <a href="{{route('offeritem.edit',['id' => $offer->id])}}" class="btn btn-white">
                              <span class="text-light">
                                <i class="material-icons">more_vert</i>
                              </span> Edit
                                                </a>
                                                <a target="_blank" href="{{$offer->link}}" class="btn btn-white">
                              <span class="text-success">
                                <i class="material-icons">check</i>
                              </span> Visit </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection