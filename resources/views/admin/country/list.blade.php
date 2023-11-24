@extends('admin.layouts.app')
@section('title', 'Country')
@section('content')
    <!-- ============================================================== -->
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><strong>Warning</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    You are about to delete this country. This action cannot be undone. Are you sure want to continue?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="confirmDelete">Confirm</button>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Modal -->
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
                                <input type="text" class="form-control form-control-line" name="country_name" />
                                @if($errors->any())
                                    @foreach($errors->all() as $error)
                                        <p style="color:red">{{$error}}</p>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <input type="submit" name="submit" value="Add Country" class="btn btn-success" />
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
                            <thead class="thead-light">
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
                                        <td><a type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal" data-country-id="{{$country->id}}" href="#"><i class="mdi mdi-close" style="font-size: 14px"></i></a></td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                var countryId;

                // When the delete button is clicked, store the country ID
                $('.btn-danger').click(function () {
                    countryId = $(this).data('country-id');
                });

                // When the confirm button is clicked, redirect to the delete URL
                $('#confirmDelete').click(function () {
                    if (countryId) {
                        window.location.href = "/admin/country/delete/" + countryId;
                    }
                });
            });
        </script>
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
