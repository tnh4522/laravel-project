@extends('admin.layouts.app')
@section('title', 'Profile')
@section('content')
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <!-- Row -->
        <div class="row">
            <!-- Column -->
            <div class="col-lg-4 col-xlg-3 col-md-5">
                <div class="card">
                    <div class="card-body">
                        <center class="m-t-30"> <img src="{{ asset('upload/user/avatar/' . Auth::user()->avatar) }}" class="rounded-circle" width="150"  alt=""/>
                            <h4 class="card-title m-t-10">{{Auth::user()->name}}</h4>
                            <h6 class="card-subtitle">Accounts Manager</h6>
                        </center>
                    </div>
                    <div>
                        <hr> </div>
                    <div class="card-body"> <small class="text-muted">Email address </small>
                        <h6>{{Auth::user()->email}}</h6> <small class="text-muted p-t-30 db">Phone</small>
                        <h6>{{Auth::user()->phone}}</h6> <small class="text-muted p-t-30 db">Address</small>
                        <h6>{{Auth::user()->address}}</h6>
                        <div class="map-box">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1916.9187207105188!2d108.14751029839476!3d16.073923200000017!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314218d68dff9545%3A0x714561e9f3a7292c!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBCw6FjaCBLaG9hIC0gxJDhuqFpIGjhu41jIMSQw6AgTuG6tW5n!5e0!3m2!1svi!2s!4v1698232924316!5m2!1svi!2s" width="100%" height="150" frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div> <small class="text-muted p-t-30 db">Social Profile</small>
                        <br/>
                        <button class="btn btn-circle btn-secondary"><i class="mdi mdi-facebook"></i></button>
                        <button class="btn btn-circle btn-secondary"><i class="mdi mdi-twitter"></i></button>
                        <button class="btn btn-circle btn-secondary"><i class="mdi mdi-youtube-play"></i></button>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <div class="col-lg-8 col-xlg-9 col-md-7">
                <div class="card">
                    <div class="card-body">
                        <form class="form-horizontal form-material" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <div id="success-alert" class="alert alert-success alert-dismissible" style="{{ session('success') ? '' : 'display: none' }}">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    {{ session('success') }}
                                </div>
                                <div id="error-alert" class="alert alert-danger alert-dismissible" style="{{ session('error') ? '' : 'display: none' }}">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    {{ session('error') }}
                                </div>
                                <label class="col-md-12">Full Name</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control form-control-line" value="{{Auth::user()->name}}" name="name">
                                    @if(isset($errors->messages()['name']))
                                        @foreach($errors->messages()['name'] as $error)
                                            <p style="color:red">{{$error}}</p>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="example-email" class="col-md-12">Email</label>
                                <div class="col-md-12">
                                    <input type="email" class="form-control form-control-line" name="email" id="example-email" value="{{Auth::user()->email}}" disabled>
                                    @if(isset($errors->messages()['email']))
                                        @foreach($errors->messages()['email'] as $error)
                                            <p style="color:red">{{$error}}</p>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Password</label>
                                <div class="col-md-12">
                                    <input type="password" class="form-control form-control-line" name="password" value="">
                                    @if(isset($errors->messages()['password']))
                                        @foreach($errors->messages()['password'] as $error)
                                            <p style="color:red">{{$error}}</p>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Phone No</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control form-control-line" name="phone" value="{{Auth::user()->phone}}">
                                    @if(isset($errors->messages()['phone']))
                                        @foreach($errors->messages()['phone'] as $error)
                                            <p style="color:red">{{$error}}</p>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Address</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control form-control-line" name="address" value="{{Auth::user()->address}}">
                                    @if(isset($errors->messages()['address']))
                                        @foreach($errors->messages()['address'] as $error)
                                            <p style="color:red">{{$error}}</p>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12">Select Country</label>
                                <div class="col-sm-12">
                                    <select class="form-control form-control-line" name="id_country">
                                        @if(isset($countries))
                                            @foreach($countries as $country)
                                                <option value="{{$country->id}}"
                                                        @if(Auth::user()->id_country == $country->id)
                                                            selected
                                                    @endif>{{$country->country_name}}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @if(isset($errors->messages()['id_country']))
                                        @foreach($errors->messages()['id_country'] as $error)
                                            <p style="color:red">{{$error}}</p>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Avatar</label>
                                <div class="col-md-12">
                                    <input type="file" class="form-control form-control-line" name="avatar" accept="image/*" value="{{Auth::user()->avatar}}">
                                    @if(isset($errors->messages()['avatar']))
                                        @foreach($errors->messages()['avatar'] as $error)
                                            <p style="color:red">{{$error}}</p>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input type="submit" name="submit" value="Update Profile" class="btn btn-success" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Column -->
        </div>
        <!-- Row -->
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
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
@endsection
