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
        <a href="{{route('category.add')}}" class="mb-2 btn btn-info mr-2">Add new Category</a>

        <div class="row">
            <div class="col">
                <div class="card card-small mb-4">
                    <div class="card-header border-bottom">
                        <h6 class="m-0">Menus List</h6>
                    </div>
                    <div class="card-body p-0 pb-3 text-center">
                        <table class="table table-bordered mb-0">
                            <thead class="bg-light">
                            <tr>
                                <th scope="col" class="border-0">Title</th>
                                <th scope="col" class="border-0">IsParent</th>
                                <th scope="col" class="border-0">Actions</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($categorys as $name => $category)
                                @foreach($category as $id => $values)
                                <tr>
                                    <td class="text-left">{{$name}}</td>

                                    <td>Parent</td>

                                    <td>
                                        <div class="blog-comments__actions">
                                            <div class="btn-group btn-group-sm">
                                                <button type="button" class="btn btn-white" @click="deleteRow({{$id}},'category')">
                              <span class="text-danger">
                                <i class="material-icons">clear</i>
                              </span> Delete
                                                </button>
                                                <a href="{{route('category.edit',['id' => $id])}}" class="btn btn-white">
                              <span class="text-light">
                                <i class="material-icons">more_vert</i>
                              </span> Edit
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                    @foreach($values as $value)
                                    <tr class="alert alert-info">
                                        <td class="text-white">{{$value['name']}}</td>
                                        <td></td>
                                        <td>
                                            <div class="blog-comments__actions">
                                                <div class="btn-group btn-group-sm">
                                                    <button type="button" class="btn btn-white" @click="deleteRow({{$value['id']}},'category')">
                              <span class="text-danger">
                                <i class="material-icons">clear</i>
                              </span> Delete
                                                    </button>
                                                    <a href="{{route('category.edit',['id' => $value['id']])}}" class="btn btn-white">
                              <span class="text-light">
                                <i class="material-icons">more_vert</i>
                              </span> Edit
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                @endforeach
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection