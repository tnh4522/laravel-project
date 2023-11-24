@extends('admin.layouts.app')
@section('title', 'Country')
@section('content')
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-12">
                <div class="card card-body">
                    <form class="form-horizontal m-t-30" method="post">
                        @csrf
                        <div class="form-group">
                            <label class="col-md-12">Country name</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control form-control-line" name="country_name" value="{{$country->country_name}}" />
                                @if($errors->any())
                                    @foreach($errors->all() as $error)
                                        <p class="text-danger">{{$error}}</p>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <input type="button" name="cancel" value="Cancel" class="btn btn-danger" onclick="window.location.href='/admin/country/list'" />
                                <input type="submit" name="submit" value="Edit Country" class="btn btn-success" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Country List</h4>
                        <div id="success-alert" class="alert alert-success alert-dismissible" style="{{ session('success') ? '' : 'display: none' }}">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            {{ session('success') }}
                        </div>
                        <div id="error-alert" class="alert alert-danger alert-dismissible" style="{{ session('error') ? '' : 'display: none' }}">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            {{ session('error') }}
                        </div>
                    </div>
                    <div class="table-responsive px-3">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Country Name</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($countries))
                                @foreach($countries as $country)
                                    <tr>
                                        <th scope="row">{{$country->id}}</th>
                                        <td>{{$country->country_name}}</td>
                                        <td><a type="button" class="btn btn-primary" href="/admin/country/edit/{{$country->id}}"><i class="mdi mdi-tooltip-edit" style="font-size: 14px"></i></a></td>
                                        <td><a type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal" href="/admin/country/delete/{{$country->id}}"><i class="mdi mdi-close" style="font-size: 14px"></i></a></td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right sidebar -->
        <!-- ============================================================== -->
        <!-- .right-sidebar -->
        <!-- ============================================================== -->
        <!-- End Right sidebar -->
        <!-- ============================================================== -->
    </div>
@endsection
