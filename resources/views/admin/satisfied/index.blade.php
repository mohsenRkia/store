@extends('admin.layouts.layout')

@section('content')


    <div id="app" class="main-content-container container-fluid px-4">
        <!-- Page Header -->
        <div class="page-header row no-gutters py-4">
            <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                <span class="text-uppercase page-subtitle">Dashboard</span>
                <h3 class="page-title">Colors List</h3>
            </div>
        </div>
        <!-- End Page Header -->
        <a href="{{route('admin.satisfied.create')}}" class="mb-2 btn btn-info mr-2">Add new Comment</a>

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
                                <th scope="col" class="border-0">User</th>
                                <th scope="col" class="border-0">Text</th>
                                <th scope="col" class="border-0">Status</th>
                                <th scope="col" class="border-0">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($satisfiedCms as $comment)
                                <tr>
                                    <td>{{$comment->user->name}}</td>
                                    <td>{{$comment->body}}</td>
                                    <td>
                                        @if($comment->status == 0)
                                        <span class="btn btn-danger">Deactive</span>
                                            @else
                                            <span class="btn btn-success">Active</span>
                                            @endif

                                    </td>
                                    <td>
                                        <div class="blog-comments__actions">
                                            <div class="btn-group btn-group-sm">
                                                <button type="button" class="btn btn-white" @click="deleteRow({{$comment->id}},'discount')">
                              <span class="text-danger">
                                <i class="material-icons">clear</i>
                              </span> Delete
                                                </button>
                                                <a href="{{route('admin.satisfied.show',['id' => $comment->id])}}" class="btn btn-white">
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
            </div>
        </div>

    </div>


@endsection